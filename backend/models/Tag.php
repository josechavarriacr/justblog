<?php

namespace backend\models;

use Yii;

class Tag extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'tbl_tag';
    }

    public function rules()
    {
        return [
        [['name'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
        'id' => 'ID',
        'name' => 'Name',
        ];
    }

    public function getTblPostTags()
    {
        return $this->hasMany(TblPostTag::className(), ['id_tag' => 'id']);
    }
}
