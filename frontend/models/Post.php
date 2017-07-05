<?php

namespace frontend\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use frontend\models\PostCategory;

class Post extends \yii\db\ActiveRecord
{

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

 public $file;

 public static function tableName()
 {
   return 'tbl_post';
 }

 public function rules()
 {
   return [
   [['title', 'url', 'descripcion', 'text'], 'required'],
   [['file'],'file'],
   [['text'], 'string'],
   [['keyword'], 'string', 'max' =>50],
   [['title'], 'string', 'max' => 128],
   [['descripcion'], 'string', 'max' => 500],
   [['url','img'], 'string', 'max' => 128],
   ];
 }

 public function attributeLabels()
 {
   return [
   'id' => 'ID',
   'title' => 'Title',
   'url' => 'Url',
   'descripcion' => 'Descripcion',
   'keyword' => 'Keyword',
   'text' => 'Text',
   'file' => 'Imagen destacada',
   ];
 }

 public function getCategory($id)
 {
   $tags = [];
   $sql = "select 
   tbl_post.id 
   from tbl_post
   inner join tbl_post_category 
   on tbl_post.id=tbl_post_category.id_post
   inner join tbl_category
   on tbl_category.id=tbl_post_category.id_category
   where tbl_category.url='$id' 
   and tbl_post.`type`='post'
   and tbl_post.`status`=1
   order by tbl_post.created_at desc";

   $connection = Yii::$app->getDb();
   $command = $connection->createCommand($sql);
   $result = $command->queryAll();
   return $result;
 }

 public function getCategories()
 {
   $tags = [];
   $sql = "select        
   tbl_category.*,
   count(tbl_category.id) as 'count' 
   from tbl_category
   inner join tbl_post_category 
   on tbl_category.id=tbl_post_category.id_category
   inner join tbl_post
   on tbl_post.id=tbl_post_category.id_post
   where tbl_post.`type`='post'
   and tbl_post.`status`=1
   group by tbl_category.name";

   $connection = Yii::$app->getDb();
   $command = $connection->createCommand($sql);
   $result = $command->queryAll();

   foreach ($result as $value) {
    $tags[] = $value;
  }

  return $tags;
}

public function getTag($id)
{
  $tags = [];
  $sql = "select 
  tbl_post.id 
  from tbl_post
  inner join tbl_post_tag 
  on tbl_post.id=tbl_post_tag.id_post
  inner join tbl_tag
  on tbl_tag.id=tbl_post_tag.id_tag
  where tbl_tag.name='$id' 
  and tbl_post.`type`='post'
  and tbl_post.`status`=1
  order by tbl_post.created_at desc";

  $connection = Yii::$app->getDb();
  $command = $connection->createCommand($sql);
  $result = $command->queryAll();
  return $result;
}
public function getTags()
{
  $tags = [];
  $sql = "select        
  tbl_tag.*,
  count(tbl_tag.id) as 'count'
  from tbl_tag
  inner join tbl_post_tag
  on tbl_tag.id=tbl_post_tag.id_tag
  inner join tbl_post
  on tbl_post.id=tbl_post_tag.id_post
  where tbl_post.`type`='post'
  and tbl_post.`status`=1
  group by tbl_tag.name";

  $connection = Yii::$app->getDb();
  $command = $connection->createCommand($sql);
  $result = $command->queryAll();

  foreach ($result as $value) {
    $tags[] = $value;
  }

  return $tags;
}

public function getTagsFront($id)
{
 $sql = "select tbl_tag.name from tbl_tag 
 inner join tbl_post_tag
 on tbl_post_tag.id_tag=tbl_tag.id
 inner join tbl_post
 on tbl_post_tag.id_post=tbl_post.id
 where tbl_post.id='$id'
 and tbl_post.`type`='post'
 and tbl_post.`status`=1 ";

 $connection = Yii::$app->getDb();
 $command = $connection->createCommand($sql);
 $result = $command->queryAll();

 $data = array();    
 foreach($result as $res){
  $data[] = $res['name'];
}
return $data;
}


}