<?php
namespace frontend\components;

use yii;
use backend\models\Metatag;
use yii\helpers\Html;

class MetaTagsSite extends yii\web\View
{
	protected function findModel()
	{
		if (($model = Metatag::find()->orderBy('id ASC')->limit(1)->one() ) !== null) {
			return $model;
		} else {
			// throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function getIcon(){
		$model = $this->findModel();
		if(!is_null($model)){
			\Yii::$app->view->registerLinkTag([
				'rel' => 'icon', 
				'type' => 'image/png', 
				'href' => $model->icon,
				]);
		}
	}
	
	public function getMetaTags()
	{
		$model = $this->findModel();
		if(!is_null($model)){ //start if
//Params
			$uri = Yii::$app->getRequest()->absoluteUrl;

			$domain = explode(Yii::$app->request->url, $uri);
			$domain = implode($domain);

			$userIp = Yii::$app->getRequest()->getUserIp();

//Seo Tags
			\Yii::$app->view->title = $model->title;
			\Yii::$app->view->registerMetaTag([
				'name' => 'application-name',
				'content' => $model->title,
				]);
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
				'content' => $model->description,
				]);
			\Yii::$app->view->registerMetaTag([
				'name' => 'keywords',
				'content' => $model->keywords,
				]);
			\Yii::$app->view->registerMetaTag([
				'name' => 'url',
				'content' => $model->url,
				]);
			\Yii::$app->view->registerLinkTag([
				'rel' => 'icon', 
				'type' => 'image/png', 
				'href' => $model->icon,
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
				'content' => $model->image,
				]);
			\Yii::$app->view->registerMetaTag([
				'property' => 'og:description',
				'content' => $model->description,
				]);

// Twitter Tags
			\Yii::$app->view->registerMetaTag([
				'name' => 'twitter:card',
				'content' => 'summary_large_image',
				]);
			\Yii::$app->view->registerMetaTag([
				'name' => 'twitter:image:src',
				'content' => $domain.$model->image,
				]);
			\Yii::$app->view->registerMetaTag([
				'name' => 'twitter:creator',
				'content' => "@josechavarriacr",
				]);

		}//end if
	}
}