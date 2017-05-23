<?php

namespace frontend\models;

use Yii;

class Logs extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'tbl_logs';
    }

    public function rules()
    {
        return [
            [['new'], 'boolean'],
            [['time'], 'integer'],
            [['ip', 'language', 'method', 'browser', 'os', 'device', 'type', 'port'], 'string', 'max' => 50],
            [['referrer', 'csrfToken', 'user_agent', 'module'], 'string', 'max' => 500],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'Ip',
            'module' => 'Module',
            'referrer' => 'Referrer',
            'new' => 'New',
            'language' => 'Language',
            'method' => 'Method',
            'browser' => 'Browser',
            'os' => 'Os',
            'device' => 'Device',
            'type' => 'Type',
            'csrfToken' => 'Csrf Token',
            'port' => 'Port',
            'user_agent' => 'User Agent',
            'time' => 'Time',
        ];
    }
}
