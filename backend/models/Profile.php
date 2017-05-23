<?php

namespace backend\models;

use Yii;

class Profile extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'tbl_profile';
    }

    public $file;
    
    public function rules()
    {
        return [
        [['id_user'], 'integer'],
        [['description'], 'string'],
        [['name', 'email', 'ip', 'image', 'facebook', 'twitter', 'linkedin', 'github'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
        'id' => 'ID',
        'name' => 'Name',
        'email' => 'Email',
        'ip' => 'Ip',
        'image' => 'Image',
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'linkedin' => 'Linkedin',
        'github' => 'Github',
        'description' => 'Description',
        ];
    }
}
