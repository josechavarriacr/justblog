<?php

namespace backend\models;

use Yii;

class TagAssign extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'tbl_post_tag';
    }

    public function rules()
    {
        return [
            [['id_post', 'id_tag'], 'integer'],
            [['id_post'], 'exist', 'skipOnError' => true, 'targetClass' => TblPost::className(), 'targetAttribute' => ['id_post' => 'id']],
            [['id_tag'], 'exist', 'skipOnError' => true, 'targetClass' => TblTag::className(), 'targetAttribute' => ['id_tag' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_post' => 'Id Post',
            'id_tag' => 'Id Tag',
        ];
    }

    public function getIdPost()
    {
        return $this->hasOne(TblPost::className(), ['id' => 'id_post']);
    }

    public function getIdTag()
    {
        return $this->hasOne(TblTag::className(), ['id' => 'id_tag']);
    }
}
