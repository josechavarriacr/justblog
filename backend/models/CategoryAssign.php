<?php

namespace backend\models;

use Yii;

class CategoryAssign extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'tbl_post_category';
    }

    public function rules()
    {
        return [
            [['id_post', 'id_category'], 'integer'],
            [['id_category'], 'exist', 'skipOnError' => true, 'targetClass' => TblCategory::className(), 'targetAttribute' => ['id_category' => 'id']],
            [['id_post'], 'exist', 'skipOnError' => true, 'targetClass' => TblPost::className(), 'targetAttribute' => ['id_post' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_post' => 'Id Post',
            'id_category' => 'Id Category',
        ];
    }

    public function getIdCategory()
    {
        return $this->hasOne(TblCategory::className(), ['id' => 'id_category']);
    }

    public function getIdPost()
    {
        return $this->hasOne(TblPost::className(), ['id' => 'id_post']);
    }
}
