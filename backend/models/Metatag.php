<?php

namespace backend\models;

use Yii;

class Metatag extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'tbl_metatag';
    }

    public $img, $ico;

    public function rules()
    {
        return [
        [['img'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        [['ico'], 'file', 'skipOnEmpty' => true, 'extensions' => 'ico'],
        [['id_user'], 'integer'],
        [['title', 'url', 'category', 'icon', 'image'], 'string', 'max' => 50],
        [['description', 'keywords'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
        'id' => 'ID',
        'id_user' => 'Id User',
        'title' => 'Title',
        'url' => 'Url',
        'description' => 'Description',
        'keywords' => 'Keywords',
        'category' => 'Category',
        'ico' => 'Icon',
        'img' => 'Image',
        'icon' => 'Icon',
        'image' => 'Image',
        ];
    }
}
