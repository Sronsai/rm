<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'th_TH',
    'timeZone' => 'Asia/Bangkok',
    'components' => [
        /*'formatter' => [
            'dateFormat' => 'dd.MM.yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'TH',
        ],*/
        'thaiFormatter' => [
            'class' => 'dixonsatit\thaiYearFormatter\ThaiYearFormatter',
        ],
        /*'formatter' => [
            'dateFormat' => 'dd.MM.yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'TH',
        ],*/
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'modules' => [
        /* 'social' => [
          // the module class
          'class' => 'kartik\social\Module',
          // the global settings for the facebook plugins widget
          'facebook' => [
          'appId' => 'FACEBOOK_APP_ID',
          'secret' => 'FACEBOOK_APP_SECRET',
          ],
          ], */
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
    ],
];
