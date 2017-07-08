<?php

namespace backend\controllers;

use Yii;
use backend\models\Post;
use backend\models\Tag;
use backend\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\helpers\Html;
use yii\helpers\FileHelper;
use yii\web\Response;

class PostController extends Controller
{
	public function behaviors()
	{	
		return [
		'access' => [
		'class' => AccessControl::className(),
		'rules' => [
		[
        'actions' => ['login', 'error'],//actions without loggin
        'allow' => true,
        ],
        [
        'actions' => ['logout','index','view','url','create','update','delete','list'],//action with login
        'allow' => true,
        'roles' => ['@'],
        ],
        ]
        ],
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

     public function actionIndex()
     {
       $searchModel = new PostSearch();
       $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

       return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        ]);
     }

     public function actionView($id)
     {
       return $this->render('view', [
        'model' => $this->findModel($id),
        ]);
     }

     public function actionList($query)
     {
       Yii::$app->response->format = Response::FORMAT_JSON;

       $items = [];
       foreach (Tag::find()->where(['like', 'name', $query])->asArray()->all() as $tag) {
        $items[] = ['name' => $tag['name']];
      }

      return $items;
    }

    public function actionCreate()
    {
    	$model = new Post();
    	if ($model->load(Yii::$app->request->post()) ) {

        $model->file = UploadedFile::getInstance($model, 'file');
        $img = $model->id.'_'.time();
        if(!empty($model->file)){
          $path = Yii::getAlias('@web/uploads/meta/');
          FileHelper::createDirectory('uploads/meta');
          $model->file->saveAS('uploads/meta/'.$img.'.'.$model->file->extension);
          $model->img = $path.$img.'.'.$model->file->extension;
        }
        $model->created_at = time();
        $model->type ='post';
        $model->save(false);
        return $this->redirect(['view', 'id' => $model->id]);
      } else {
        return $this->render('create', [
         'model' => $model,
         ]);
      }
    }

    public function actionUpdate($id)
    {
     $model = $this->findModel($id);
     $model->tags = Post::getTags($id);
     $model->categories = Post::getCategories($id);

     if ($model->load(Yii::$app->request->post()) ) {

      $model->file = UploadedFile::getInstance($model, 'file');
      $img = $model->id.'_'.time();
      if(!empty($model->file)){
        $path = Yii::getAlias('@web/uploads/meta/');
        FileHelper::createDirectory('uploads/meta');
        $model->file->saveAS('uploads/meta/'.$img.'.'.$model->file->extension);
        $model->img = $path.$img.'.'.$model->file->extension;
      }

      $model->save(false);
      return $this->redirect(['view', 'id' => $model->id]);

    } else {
      return $this->render('update', [
       'model' => $model,
       ]);
    }
  }

  public function actionDelete($id)
  {
   $this->findModel($id)->delete();

   return $this->redirect(['index']);
 }

 protected function findModel($id)
 {
   if (($model = Post::findOne($id)) !== null) {
    return $model;
  } else {
    throw new NotFoundHttpException('The requested page does not exist.');
  }
}

public function actionUrl($url)
{ 
 $model = Post::find()->where(['url'=>$url])->one();
 if (!is_null($model)) {
  return $this->render('view', [
   'model' => $model,
   ]);      
} else {
    		// return $this->redirect('site/error');
  throw new NotFoundHttpException('The requested page does not exist.');
}
}
}
