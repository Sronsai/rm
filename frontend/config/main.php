<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
            'mailer' => [
                   'class' => 'yii\swiftmailer\Mailer',
                        'viewPath' => '@frontend/mail',
                        'useFileTransport' => false,
                        'transport' => [
                            'class' => 'Swift_SmtpTransport',
                            'host' => 'smtp.gmail.com',
                            'username' => 'username@gmail.com',
                            'password' => 'password',
                            'port' => '587',
                            'encryption' => 'tls',
                        ],
                    ],
        'formatter' => [   //กรณีไม่ให้แสดงผล (ไม่ได้ตั้ง) ในฐานข้อมูล
                'class' => 'yii\i18n\Formatter',
                'nullDisplay' => '',
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                ],
            ],
        ],
        'image' => [
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD', //GD or Imagick
        ],
        /* 'urlManager' => [
          'class' => 'yii\web\urlManager',
          'baseUrl' => $baseUrl,
          'enablePrettyUrl' => true,
          'showScriptName' => false,
          //'rules' => [],
          //'class' => 'yii\web\urlManager',
          //'enablePrettyUrl' => false,
          //'showScriptName' => true,
          ], */
        'urlManagerBackend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/rm/backend/web',
            'scriptUrl' => '/rm/backend/web/index.php',
            'enablePrettyUrl' => false,
            'showScriptName' => true,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
