<?php

namespace backend\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use \yii\helpers\ArrayHelper;
use backend\models\CategoryAssign;
use backend\models\TagAssign;
use backend\models\Tag;
use yii\web\NotFoundHttpException;

class Post extends \yii\db\ActiveRecord
{

	public static function tableName()
	{
		return 'tbl_post';
	}

	public function behaviors()
	{
		return [
		[
		'class' => SluggableBehavior::className(),
		'attribute' => 'descripcion',
		'slugAttribute' => 'url',
		],
		];
	}

	public $file, $categories, $tags;


	public function rules()
	{
		return [
		[['titulo', 'url', 'descripcion', 'text', 'type'], 'required'],
		[['file'],'file'],
		[['text','type'], 'string'],
		[['count', 'created_at'], 'integer'],
		[['status'], 'boolean'],
		[['categories','tags'], 'safe'],
		[['keyword'], 'string', 'max' =>50],
		[['titulo'], 'string', 'max' => 128],
		[['descripcion'], 'string', 'max' => 500],
		[['url','img'], 'string', 'max' => 128],
		];
	}

	public function attributeLabels()
	{
		return [
		'id' => 'ID',
		'titulo' => 'Titulo',
		'url' => 'Url',
		'descripcion' => 'Descripcion',
		'keyword' => 'Keyword',
		'text' => 'Text',
		'file' => 'Imagen destacada',
		'categories' => 'Categories',
		];
	}

	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			if (!is_null($this->categories) && !empty($this->categories)) {
				CategoryAssign::deleteAll(['id_post'=>$this->id]);
				foreach($this->categories as $id){       
					$category = new CategoryAssign;
					$category->id_post = $this->id;
					$category->id_category = $id;
					$category->save(false);
				}
			}
			if (!is_null($this->tags) && !empty($this->tags)) {
				TagAssign::deleteAll(['id_post'=>$this->id]);

				$array = explode(',',$this->tags);

				foreach($array as $name){       
					$TagAssign = new TagAssign;
					$TagAssign->id_post = $this->id;

					if ($tag = $this->findTag($name)) {
						$TagAssign->id_tag = $tag->id;
					} 
					$TagAssign->save(false);
				} 
			}        
			return true;
		} else {
			return false;
		}
	}

	protected function findTag($name)
	{
		if (($model = Tag::findOne(['name'=>$name])) !== null) {
			return $model;
    } else {// throw new NotFoundHttpException('The requested page does not exist.');
    $query = new Tag(['name' => $name]);
    if ($query->save()) {
    	return $query;
    }
}
}

public function getTags($id)
{
	$sql = "select tbl_tag.name from tbl_tag 
	inner join tbl_post_tag
	on tbl_post_tag.id_tag=tbl_tag.id
	inner join tbl_post
	on tbl_post_tag.id_post=tbl_post.id
	where tbl_post.id='$id' ";

	$connection = Yii::$app->getDb();
	$command = $connection->createCommand($sql);
	$result = $command->queryAll();

	$data = [];    
	foreach($result as $res){
		$data[] = $res['name'];
	}
	$data = implode(',', $data);
	return $data;
}

public function getCategories($id)
{
	$data = [];
	$sql = "select tbl_category.id from tbl_category
	inner join tbl_post_category
	on tbl_post_category.id_category=tbl_category.id
	inner join tbl_post
	on tbl_post_category.id_post=tbl_post.id
	where tbl_post.id='$id' ";

	$connection = Yii::$app->getDb();
	$command = $connection->createCommand($sql);
	$result = $command->queryAll();

	foreach ($result as $value) {
		$data[] = $value['id'];
	}

	return $data;
}

public function getTblPostCategories()
{
	return $this->hasMany(TblPostCategory::className(), ['id_post' => 'id']);
}

public function getTblPostTags()
{
	return $this->hasMany(TblPostTag::className(), ['id_post' => 'id']);
}
}
