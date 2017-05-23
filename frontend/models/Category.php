<?php

namespace frontend\models;

use Yii;

class Category extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'tbl_category';
    }

    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
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
        ];
    }

    public function getTblPostCategories()
    {
        return $this->hasMany(TblPostCategory::className(), ['id_category' => 'id']);
    }
}
