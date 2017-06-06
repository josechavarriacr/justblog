<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Post;
use frontend\models\PostSearch;
use frontend\models\Category;
use frontend\models\Tag;
use frontend\components\Analytics;
use backend\models\Profile;
use backend\models\Metatag;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use frontend\components\feed\Feed;
use frontend\components\feed\Item;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use yii\helpers\Markdown;
use yii\helpers\Html;
use yii\base\DynamicModel;
use yii\helpers\ArrayHelper;


class PostController extends Controller
{
	public function behaviors()
	{
		// Analytics::init();
		return [
		'verbs' => [
		'class' => VerbFilter::className(),
		'actions' => [
		'delete' => ['POST'],
		],
		],
		];
	}

	public function actions()
	{
		return [
		'error' => [
		'class' => 'yii\web\ErrorAction',
		],
		];
	}
	
	public function actionIndex(){
		$Dynamic = new \yii\base\DynamicModel([ 'var']);
		$Dynamic->addRule(['var'], 'required', ['message' => Yii::t('app', 'La búsqueda no puede estar vacía')]);

		$query = Post::find()->where(['type'=>'post'])->andWhere(['status'=>1])->orderBy(['created_at'=>SORT_DESC]);
		$countQuery = clone $query;
		$data = ArrayHelper::map($countQuery->all(), 'url', 'titulo');
		$pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>6]);

		$models = $query->offset($pages->offset)
		->limit($pages->limit)
		->all();

		if($Dynamic->load(Yii::$app->request->post())){
			return $this->redirect(['url','url'=>$Dynamic->var]);
		}

		return $this->render('index',[
			'models' => $models,
			'pages' => $pages,
			'Dynamic' => $Dynamic,
			'data' => $data,
			]);
	}

	public function actionView($id)
	{
		return $this->render('view');
	}

	protected function findModel($id)
	{
		if (($model = Post::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	protected function ipUser(){
		$profile = profile::find()->orderBy('id ASC')->limit(1)->one();
		$ip = Yii::$app->getRequest()->getUserIP();
		if (!is_null($profile->ip) && $profile->ip == $ip) {
			return false;
		}else{
			return true;
		}
	}

	public function actionUrl($url)
	{ 
		$model = Post::find()->where(['url'=>$url])->andWhere(['type'=>'post'])->andWhere(['status'=>1])->one();
		if (!is_null($model)) {

			if($this->ipUser()){
				$model->count = $model->count + 1;
				$model->save(false);
			}
			return $this->render('view', [
				'model' => $model,
				]);      
		} else {
			return $this->redirect(['/error']);
			// throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function actionCategory($category){
		$verify = Category::find()->where(['url'=>$category])->exists();
		if ($verify) {

			$Dynamic = new \yii\base\DynamicModel([ 'var']);
			$Dynamic->addRule(['var'], 'required', ['message' => Yii::t('app', 'La búsqueda no puede estar vacía')]);

			$query = Post::find()->where(['id'=>Post::getCategory($category)]);
			$countQuery = clone $query;
			$data = ArrayHelper::map($countQuery->all(), 'url', 'titulo');
			$pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>6]);

			$models = $query->offset($pages->offset)
			->limit($pages->limit)
			->all();

			$modelCategory = Category::find()->where(['url'=>$category])->one();

			if($Dynamic->load(Yii::$app->request->post())){
				return $this->redirect(['url','url'=>$Dynamic->var]);
			}

			return $this->render('_category',[
				'models' => $models,
				'pages' => $pages,
				'Dynamic' => $Dynamic,
				'data' => $data,
				'modelCategory' => $modelCategory,
				]);
			// print_r("Si existe");
		} else {
			// print_r("No existe");
			return $this->redirect(['/error']);
		}
	}

	public function actionTag($category){
		$verify = Tag::find()->where(['name'=>$category])->exists();
		if ($verify) {

			$Dynamic = new \yii\base\DynamicModel([ 'var']);
			$Dynamic->addRule(['var'], 'required', ['message' => Yii::t('app', 'La búsqueda no puede estar vacía')]);

			$query = Post::find()->where(['id'=>Post::getTag($category)]);
			$countQuery = clone $query;
			$data = ArrayHelper::map($countQuery->all(), 'url', 'titulo');
			$pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>6]);

			$models = $query->offset($pages->offset)
			->limit($pages->limit)
			->all();

			$modelTag = Tag::find()->where(['name'=>$category])->one();

			if($Dynamic->load(Yii::$app->request->post())){
				return $this->redirect(['url','url'=>$Dynamic->var]);
			}

			return $this->render('_tags',[
				'models' => $models,
				'pages' => $pages,
				'Dynamic' => $Dynamic,
				'data' => $data,
				'modelTag' => $modelTag,
				]);
			// print_r("Si existe");
		} else {
			// print_r("No existe");
			return $this->redirect(['/error']);
		}
	}

	protected function isBoolean($meta, $profile, $news){
		if (!is_null($meta) && !empty($meta)) {
			if (!is_null($profile) && !empty($profile)){
				if (!is_null($news) && !empty($news)){
					return true;
				}
			}
		}
	}

	public function actionRss()
	{
		$meta = Metatag::find()->select(['title','description'])->orderBy('id ASC')->limit(1)->one();
		$profile = profile::find()->select(['name','email'])->orderBy('id ASC')->limit(1)->one();
		$news = Post::find()->orderBy('created_at DESC')->limit(100)->all();

		if ($this->isBoolean($meta, $profile, $news)) {
			$feed = new Feed();
			$feed->title = $meta->title;
			$feed->link = Url::to('');
			$feed->selfLink = Url::to(['post/rss'], true);
			$feed->description = $meta->description;
			$feed->language = Yii::$app->language;
			$feed->setWebMaster($profile->email, $profile->name);
			$feed->setManagingEditor($profile->email, $profile->name);

			foreach ($news as $post) {
				$item = new Item();
				$item->title = $post->titulo;
				$item->link = Url::to([$post->url], true);
				$item->guid = Url::to([$post->url], true);
				$item->description = HtmlPurifier::process(Markdown::process($post->descripcion));

				if (!empty($post->url)) {
					$item->description .= "leer más en el siguiente link: ".Html::a(Html::encode($post->url), $post->url);
				}

				$item->pubDate = $post->created_at;
				$item->setAuthor($profile->email, $profile->name);
				$feed->addItem($item);
			}
			$feed->render();
		} else {
			Yii::$app->session->setFlash('info','Empty Information, check backend');
			return $this->redirect(['/error']);

		}
	}

}
