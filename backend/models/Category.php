<?php

namespace backend\models;

use Yii;

class Category extends \yii\db\ActiveRecord
{
    public $file;
    public static function tableName()
    {
        return 'tbl_category';
    }

    public function rules()
    {
        return [
        [['name','url'], 'required'],
        [['file'], 'file'],
        [['name', 'url', 'img'], 'string', 'max' => 128],
        [['description'], 'string', 'max' => 500],
        ];
    }

    public function attributeLabels()
    {
        return [
        'id' => 'ID',
        'name' => 'Name',
        'description' => 'Description',
        'url' => 'Url',
        'img' => 'Img',
        'file' => 'Imagen destacada',
        ];
    }

    public function getTblPostCategories()
    {
        return $this->hasMany(TblPostCategory::className(), ['id_category' => 'id']);
    }
}
