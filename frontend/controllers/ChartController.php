<?php

namespace frontend\controllers;

use yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\components\AccessRule;
use common\models\User;

class ChartController extends \yii\web\Controller {

    public $enableCsrfValidation = false;

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['report', 'report5', 'report3', 'report4'],
                'ruleConfig' => [
                    'class' => AccessRule::className()
                ],
                'rules' => [
                    [
                        //'actions' => ['report', 'report5', 'report3', 'report4'],
                        'allow' => true,
                        'roles' => [
                            //User::ROLE_USER,
                            User::ROLE_MODERATOR,
                            User::ROLE_ADMIN
                        ]
                    ],
                /* [
                  'actions' => ['update'],
                  'allow' => true,
                  'roles' => [
                  User::ROLE_MODERATOR,
                  User::ROLE_ADMIN
                  ]
                  ],
                  [
                  'actions' => ['delete'],
                  'allow' => true,
                  'roles' => [User::ROLE_ADMIN]
                  ] */
                ]
            ]
        ];
    }

    public function actionIndex() {

        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');

        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
        }

        $sql = " SELECT location_riks_id,location_name,SUM(total) AS total
                    FROM(
                    SELECT r.location_riks_id,l.location_name,count(l.location_name) AS total
                    FROM risk r
                    INNER JOIN location_riks l ON l.id = r.location_riks_id
                    WHERE risk_date BETWEEN '$date1' and '$date2'
                    GROUP BY r.location_riks_id
                    UNION ALL
                    SELECT rd.location_riks_id,l.location_name,count(l.location_name) AS total
                    FROM risk_med rd
                    INNER JOIN location_riks l ON l.id = rd.location_riks_id
                    WHERE risk_date BETWEEN '$date1' and '$date2'
                    GROUP BY rd.location_riks_id
                    ) AS tb
                    GROUP BY location_name
                    ORDER BY total DESC
                    LIMIT 10 ";

        $rawData = Yii::$app->db->createCommand($sql)->queryAll();
        $main_data = [];
        foreach ($rawData as $data) {
            $main_data[] = [
                'name' => $data['location_name'],
                'y' => $data['total'] * 1,
                    //'drilldown' => $data['location_riks_id']
            ];
        }
        $main = json_encode($main_data);





        $sql_level = "SELECT level,SUM(total) as total
                            FROM(
                                                    SELECT l.level_e as level,count(l.level_name) as total FROM risk r
                                                    LEFT OUTER JOIN level l ON l.id = r.level_id
                                                    WHERE risk_date BETWEEN '$date1' and '$date2'
                                                    GROUP BY level
                            UNION ALL

                                                    SELECT l.level_e as level,count(l.level_name) as total FROM risk_med rd
                                                    LEFT OUTER JOIN level l ON l.id = rd.level_id
                                                    WHERE risk_date BETWEEN '$date1' and '$date2'
                                                    GROUP BY level
                            ) AS tb
                            GROUP BY level ASC";

        $rawData_level = Yii::$app->db->createCommand($sql_level)->queryAll();

        $main_data_level = [];
        foreach ($rawData_level as $data_level) {
            $main_data_level[] = [
                'name' => $data_level['level'],
                'y' => $data_level['total'] * 1,
            ];
        }
        $main_level = json_encode($main_data_level);



        return $this->render('index', [
                    'main' => $main,
                    'date1' => $date1,
                    'date2' => $date2,
                    'sql_level' => $sql_level,
                    'main_level' => $main_level,
        ]);
    }

}
