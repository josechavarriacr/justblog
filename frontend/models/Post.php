<?php

namespace frontend\models;

use frontend\models\PostCategory;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;

/**
 * Class Post
 * @package frontend\models
 */
class Post extends ActiveRecord
{
    /**
     * @var
     */
    public $file;

    public static function tableName()
    {
        return 'tbl_post';
    }

    /**
     * @inheritdoc
     * @return array
     */
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

    /**
     * @inheritdoc
     * @return array
     */
    public function rules()
    {
        return [
            [['title', 'url', 'descripcion', 'text'], 'required'],
            [['file'], 'file'],
            [['text'], 'string'],
            [['repo'], 'string', 'max' => 64],
            [['title', 'keyword'], 'string', 'max' => 128],
            [['descripcion'], 'string', 'max' => 500],
            [['url', 'img'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'url' => 'Url',
            'descripcion' => 'Descripcion',
            'keyword' => 'Keyword',
            'repo' => 'GitHub Repo',
            'text' => 'Text',
            'file' => 'Imagen destacada',
        ];
    }

    /**
     * @param $id
     * @return mixed
     */
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

    /**
     * @return array
     */
    public function getCategories()
    {
        $tags = [];
        $sql = "SELECT        
   tbl_category.*,
   count(tbl_category.id) AS 'count' 
   FROM tbl_category
   INNER JOIN tbl_post_category 
   ON tbl_category.id=tbl_post_category.id_category
   INNER JOIN tbl_post
   ON tbl_post.id=tbl_post_category.id_post
   WHERE tbl_post.`type`='post'
   AND tbl_post.`status`=1
   GROUP BY tbl_category.name";

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand($sql);
        $result = $command->queryAll();

        foreach ($result as $value) {
            $tags[] = $value;
        }

        return $tags;
    }

    /**
     * @param $id
     * @return mixed
     */
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

    /**
     * @return array
     */
    public function getTags()
    {
        $tags = [];
        $sql = "SELECT        
  tbl_tag.*,
  count(tbl_tag.id) AS 'count'
  FROM tbl_tag
  INNER JOIN tbl_post_tag
  ON tbl_tag.id=tbl_post_tag.id_tag
  INNER JOIN tbl_post
  ON tbl_post.id=tbl_post_tag.id_post
  WHERE tbl_post.`type`='post'
  AND tbl_post.`status`=1
  GROUP BY tbl_tag.name";

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand($sql);
        $result = $command->queryAll();

        foreach ($result as $value) {
            $tags[] = $value;
        }

        return $tags;
    }

    /**
     * @param $id
     * @return array
     */
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

        $data = [];
        foreach ($result as $res) {
            $data[] = $res['name'];
        }

        return $data;
    }
}
