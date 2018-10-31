<?php

namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * Class Category
 * @property TblPostCategories[] $tblPostCategories
 * @package frontend\models
 */
class Category extends ActiveRecord
{

    /**
     * @inheritdoc
     * @return string
     */
    public static function tableName()
    {
        return '{{%tbl_category}}';
    }

    /**
     * @inheritdoc
     * @return array
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['name', 'url', 'img'], 'string', 'max' => 128],
            [['description'], 'string', 'max' => 500],
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
            'name' => 'Name',
            'description' => 'Description',
            'url' => 'Url',
            'img' => 'Img',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblPostCategories()
    {
        return $this->hasMany(TblPostCategory::className(), ['id_category' => 'id']);
    }
}
