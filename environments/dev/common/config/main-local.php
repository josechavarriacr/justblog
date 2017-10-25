<?php
return [
    'bootstrap' => ['Analytics'],
    'params' => [
        'icon-framework' => 'fi'  // set elusive icon font as default framework
    ],
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=blogdb',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
          'Analytics' => [
            'class' => 'frontend\components\Analytics',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
