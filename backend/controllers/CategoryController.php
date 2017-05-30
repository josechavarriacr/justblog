<?php

namespace backend\controllers;

use Yii;
use backend\models\Category;
use backend\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

class CategoryController extends Controller
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
        'actions' => ['logout','index','view','create','update','delete'],//action with login
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
        $searchModel = new CategorySearch();
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

    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post()) ) {
            $imageName = time();
            $model->file = UploadedFile::getInstance($model, 'file');
            $path = Yii::getAlias('@web/uploads/meta/');
            if (!empty($model->file)) {
                $model->file->saveAs('uploads/meta/'.$imageName.'.'.$model->file->extension);
                $model->img = $path.$imageName.'.'.$model->file->extension;
            }
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

        if ($model->load(Yii::$app->request->post()) ) {
            $imageName = time();
            $model->file = UploadedFile::getInstance($model,'file');
            $path = Yii::getAlias('@web/uploads/meta/');
            if (!empty($model->file)) {
                $model->file->saveAs('uploads/meta/'.$imageName.'.'.$model->file->extension);
                $model->img = $path.$imageName.'.'.$model->file->extension;
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
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
