<?php

namespace backend\controllers;

use Yii;
use backend\models\Metatag;
use backend\models\MetatagSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

class MetatagController extends Controller
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
        'actions' => ['logout','index','view','update','delete'],//action with login
        'allow' => true,
        'roles' => ['@'],
        ],
        ]
        ],
        'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
        'flush-cache' => ['POST'],
        'clear-assets' => ['POST'],
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
		$searchModel = new MetatagSearch();
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
	
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) ) {
			$nameIco = 'ico';
			$model->ico = UploadedFile::getInstance($model, 'ico');
			if(!empty($model->ico)){
				$pathIco = Yii::getAlias('@web/uploads/profile/');
				$model->ico->saveAS('uploads/profile/'.$nameIco.'.'.$model->ico->extension);
				$model->icon = $pathIco.$nameIco.'.'.$model->ico->extension;
			}

			$model->img = UploadedFile::getInstance($model, 'img');
			if(!empty($model->img)){
				$pathImg = Yii::getAlias('@web/uploads/profile/');
				$model->img->saveAS('uploads/profile/'.$model->img->name);
				$model->image = $pathImg.$model->img->name;
			}

			$model->save(false);
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('update', [
				'model' => $model,
				]);
		}
	}

	protected function findModel($id)
	{
		if (($model = Metatag::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
