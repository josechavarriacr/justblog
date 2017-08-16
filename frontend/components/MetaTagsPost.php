<?php
namespace frontend\components;

use yii;
use frontend\models\Post;
use backend\models\Metatag;
use yii\helpers\Html;

class MetaTagsPost extends yii\web\View
{
	protected function findModel($id)
	{
		if (($model = Post::findOne($id)) !== null) {
			return $model;
		} else {
			// throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
	
	protected function findSite()
	{
		if (($model = Metatag::find()->orderBy('id ASC')->limit(1)->one() ) !== null) {
			return $model;
		} else {
			// throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
	public function getMetaTags($id)
	{
		$model = $this->findModel($id);
		if (!is_null($model)) { //start if

//load img for empty value
			if(is_null($model->img)){
				$var = $this->findSite();
				$model->img=$var->image;
			}

//Params
			$uri = Yii::$app->getRequest()->absoluteUrl;
			$domain = explode(Yii::$app->request->url, $uri);
			$domain = implode($domain);
			$userIp = Yii::$app->getRequest()->getUserIp();

//Seo Tags
			\Yii::$app->view->title = $model->title;
			\Yii::$app->view->registerMetaTag([
				'name' => 'robots',
				'content' => 'index, follow',
				]);
			\Yii::$app->view->registerMetaTag([
				'name' => 'category',
				'content' => 'IT',
				]);
			\Yii::$app->view->registerMetaTag([
				'name' => 'generator',
				'content' => 'Yii Framework',
				]);
			\Yii::$app->view->registerMetaTag([
				'name' => 'description',
				'content' => $model->descripcion,
				]);
			\Yii::$app->view->registerMetaTag([
				'name' => 'keywords',
				'content' => $model->keyword,
				]);

// Open Graph data
			\Yii::$app->view->registerMetaTag([
				'property' => 'og:title',
				'content' => $model->title,
				]);
			\Yii::$app->view->registerMetaTag([
				'property' => 'og:type',
				'content' => 'article',
				]);
			\Yii::$app->view->registerMetaTag([
				'property' => 'og:og:url',
				'content' => $uri,
				]);
			\Yii::$app->view->registerMetaTag([
				'property' => 'og:image',
				'content' => $domain.$model->img,
				]);
			\Yii::$app->view->registerMetaTag([
				'property' => 'og:description',
				'content' => $model->descripcion,
				]);

// Twitter Tags
			\Yii::$app->view->registerMetaTag([
				'name' => 'twitter:card',
				'content' => 'summary_large_image',
				]);
			\Yii::$app->view->registerMetaTag([
				'name' => 'twitter:image:src',
				'content' => $domain.$model->img,
				]);
			\Yii::$app->view->registerMetaTag([
				'name' => 'twitter:creator',
				'content' => "@josechavarriacr",
				]);

		} //end if
	}
}