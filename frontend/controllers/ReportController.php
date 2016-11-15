<?php

namespace frontend\controllers;

use yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\components\AccessRule;
use common\models\User;

class ReportController extends \yii\web\Controller {

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

    public function actionReport() {

        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');

        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
        }

        $sql = "select r.id,r.hn,r.risk_date,concat(r.pname,r.fname,'  ',r.lname) as fullname
            ,lr.location_name
            ,r.risk_summary
            ,le.level_e
            ,ty.type_name as type
            ,s.system_name as system
            ,st.status_name as status
            ,r.risk_review
            from risk r
left outer join person p on p.id = r.person_id
left outer join type ty on ty.id = r.type_id
left outer join location_riks lr on lr.id = r.location_riks_id
left outer join level le on le.id = r.level_id
left outer join system s on s.id = r.system_id
left outer join status st on st.id = r.status_id
where risk_date between '$date1' and '$date2'";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);


        return $this->render('index', [

                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2,
        ]);
    }

    public function actionReport1() {

        //$date1 = date('Y-m-d');
        //$date2 = date('Y-m-d');
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        $location = '';

        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
            $location = $_POST['location'];
        }

        $sql = "select r.id,r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
            ,lr.location_name
            ,r.risk_summary
            ,le.level_e
            ,ty.type_name as type
            ,s.system_name as system
            ,r.risk_review
            ,st.status_name as status
            from risk r
left outer join person p on p.id = r.person_id
left outer join type ty on ty.id = r.type_id
left outer join location_riks lr on lr.id = r.location_riks_id
left outer join level le on le.id = r.level_id
left outer join system s on s.id = r.system_id
left outer join status st on st.id = r.status_id
where risk_date between '$date1' and '$date2'";

        if ($location != '') {
            $sql = "select r.id,r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
            ,lr.location_name
            ,r.risk_summary
            ,le.level_e
            ,ty.type_name as type
            ,s.system_name as system
            ,r.risk_review
            ,st.status_name as status
            from risk r
left outer join person p on p.id = r.person_id
left outer join type ty on ty.id = r.type_id
left outer join location_riks lr on lr.id = r.location_riks_id
left outer join level le on le.id = r.level_id
left outer join system s on s.id = r.system_id
left outer join status st on st.id = r.status_id
where risk_date between '$date1' and '$date2'  and r.location_riks_id = $location";
        }

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);


        return $this->render('report1', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2,
                    'location' => $location,
        ]);
    }

    public function actionReport2() {

        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');

        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
        }

        $sql = "SELECT l.location_name AS location,
                SUM(CASE WHEN r.level_id='1' THEN 1 ELSE 0 END)AS A,
                SUM(CASE WHEN r.level_id='2' THEN 1 ELSE 0 END)AS B,
                SUM(CASE WHEN r.level_id='3' THEN 1 ELSE 0 END)AS C,
                SUM(CASE WHEN r.level_id='4' THEN 1 ELSE 0 END)AS D,
                SUM(CASE WHEN r.level_id='5' THEN 1 ELSE 0 END)AS E,
                SUM(CASE WHEN r.level_id='6' THEN 1 ELSE 0 END)AS F,
                SUM(CASE WHEN r.level_id='7' THEN 1 ELSE 0 END)AS G,
                SUM(CASE WHEN r.level_id='8' THEN 1 ELSE 0 END)AS H,
                SUM(CASE WHEN r.level_id='9' THEN 1 ELSE 0 END)AS I,
                SUM(CASE WHEN r.level_id<>'' THEN 1 ELSE 0 END)AS TOTAL
                FROM rm.risk r
                INNER JOIN rm.location_riks l ON l.id = r.location_riks_id
                WHERE r.risk_date BETWEEN '$date1' and '$date2'
                GROUP BY r.location_riks_id
                UNION ALL
                SELECT 'TOTAL' AS location,
                SUM(CASE WHEN r.level_id='1' THEN 1 ELSE 0 END)AS A,
                SUM(CASE WHEN r.level_id='2' THEN 1 ELSE 0 END)AS B,
                SUM(CASE WHEN r.level_id='3' THEN 1 ELSE 0 END)AS C,
                SUM(CASE WHEN r.level_id='4' THEN 1 ELSE 0 END)AS D,
                SUM(CASE WHEN r.level_id='5' THEN 1 ELSE 0 END)AS E,
                SUM(CASE WHEN r.level_id='6' THEN 1 ELSE 0 END)AS F,
                SUM(CASE WHEN r.level_id='7' THEN 1 ELSE 0 END)AS G,
                SUM(CASE WHEN r.level_id='8' THEN 1 ELSE 0 END)AS H,
                SUM(CASE WHEN r.level_id='9' THEN 1 ELSE 0 END)AS I,
                SUM(CASE WHEN r.level_id<>'' THEN 1 ELSE 0 END)AS TOTAL
                FROM rm.risk r
                INNER JOIN rm.location_riks l ON l.id = r.location_riks_id
                WHERE r.risk_date BETWEEN '$date1' and '$date2'
                ORDER BY total ASC ";


        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);


        return $this->render('report2', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2,
        ]);
    }

    public function actionReport3() {

        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        $location = '';

        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
            $location = $_POST['location'];
        }

        /* if (Yii::$app->request->isPost) {
          $date1 = $_POST['date1'];
          $date2 = $_POST['date2'];
          } */

        $sql = "select r.id,r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
            ,lr.location_name
            ,r.risk_summary
            ,le.level_e
            ,ty.type_name as type
            ,s.system_name as system
            ,r.risk_review
            ,st.status_name as status
            from risk r
left outer join person p on p.id = r.person_id
left outer join type ty on ty.id = r.type_id
left outer join location_riks lr on lr.id = r.location_riks_id
left outer join level le on le.id = r.level_id
left outer join system s on s.id = r.system_id
left outer join status st on st.id = r.status_id
where risk_date between '$date1' and '$date2'
and r.status_id = '1'";

        if ($location != '') {
            $sql = "select r.id,r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
            ,lr.location_name
            ,r.risk_summary
            ,le.level_e
            ,ty.type_name as type
            ,s.system_name as system
            ,r.risk_review
            ,st.status_name as status
            from risk r
left outer join person p on p.id = r.person_id
left outer join type ty on ty.id = r.type_id
left outer join location_riks lr on lr.id = r.location_riks_id
left outer join level le on le.id = r.level_id
left outer join system s on s.id = r.system_id
left outer join status st on st.id = r.status_id
where risk_date between '$date1' and '$date2'
    and r.location_riks_id = $location
and r.status_id = '1'";
        }

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);


        return $this->render('report3', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2,
                    'location' => $location,
        ]);
    }

    public function actionReport4() {

        $date1 = date('2014-01-01');
        $date2 = date('Y-m-d');

        /* if (Yii::$app->request->isPost) {
          $date1 = $_POST['date1'];
          $date2 = $_POST['date2'];
          } */

        $sql = "select r.id,r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
            ,lr.location_name
            ,r.risk_summary
            ,le.level_e
            ,ty.type_name as type
            ,s.system_name as system
            ,r.risk_review
            ,st.status_name as status
            from risk r
left outer join person p on p.id = r.person_id
left outer join type ty on ty.id = r.type_id
left outer join location_riks lr on lr.id = r.location_riks_id
left outer join level le on le.id = r.level_id
left outer join system s on s.id = r.system_id
left outer join status st on st.id = r.status_id
where risk_date between '$date1' and '$date2'
and r.level_id in ('7','8','9') ";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);


        return $this->render('report4', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2,
        ]);
    }

    public function actionReport5() {

        $date1 = date('Y-m-1');
        $date2 = date('Y-m-31');

        /* if (Yii::$app->request->isPost) {
          $date1 = $_POST['date1'];
          $date2 = $_POST['date2'];
          } */

        $sql = "select r.id,r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
            ,lr.location_name
            ,r.risk_summary
            ,le.level_e
            ,ty.type_name as type
            ,s.system_name as system
            ,r.risk_review
            ,st.status_name as status
            from risk r
left outer join person p on p.id = r.person_id
left outer join type ty on ty.id = r.type_id
left outer join location_riks lr on lr.id = r.location_riks_id
left outer join level le on le.id = r.level_id
left outer join system s on s.id = r.system_id
left outer join status st on st.id = r.status_id
where risk_date between '$date1' and '$date2'";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);


        return $this->render('report5', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionReport6() {

        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        $type = '';

        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
            $type = $_POST['type'];
        }

        $sql = " SELECT l.location_name,t.type_name,st.sub_type_name,COUNT(st.sub_type_name) AS total FROM risk r
                        LEFT OUTER JOIN location_riks l ON l.id = r.location_riks_id
                        LEFT OUTER JOIN type t ON t.id = r.type_id
                        LEFT OUTER JOIN sub_type st ON st.id = r.sub_type_id
                        WHERE r.risk_date BETWEEN '$date1' AND '$date2'
                        GROUP BY l.location_name,st.sub_type_name
                        ORDER BY total DESC ";

        if ($type != '') {
            $sql = "SELECT l.location_name,t.type_name,st.sub_type_name,COUNT(st.sub_type_name) AS total FROM risk r
                        LEFT OUTER JOIN location_riks l ON l.id = r.location_riks_id
                        LEFT OUTER JOIN type t ON t.id = r.type_id
                        LEFT OUTER JOIN sub_type st ON st.id = r.sub_type_id
                        WHERE r.risk_date BETWEEN '$date1' AND '$date2'
                        AND r.type_id = $type
                        GROUP BY l.location_name,st.sub_type_name
                        ORDER BY total DESC";
        }

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => TRUE,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('report6', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2,
                    'type' => $type,
        ]);
    }

    public function actionReport7() {

        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');

        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
        }

        $sql_chart = " SELECT lr.location_name,COUNT(r.location_report_id) AS total FROM risk r
                LEFT OUTER JOIN location_report lr ON lr.id = r.location_report_id
                WHERE r.risk_date BETWEEN '$date1' AND '$date2'
                GROUP BY lr.location_name
                ORDER BY total DESC LIMIT 10";

        $rawData = Yii::$app->db->createCommand($sql_chart)->queryAll();
        $main_data = [];
        foreach ($rawData as $data) {
            $main_data[] = [
                'name' => $data['location_name'],
                'y' => $data['total'] * 1,
                    //'drilldown' => $data['location_riks_id']
            ];
        }
        $main = json_encode($main_data);

        $sql = " SELECT lr.location_name,COUNT(r.location_report_id) AS total FROM risk r
                LEFT OUTER JOIN location_report lr ON lr.id = r.location_report_id
                WHERE r.risk_date BETWEEN '$date1' AND '$date2'
                GROUP BY lr.location_name
                ORDER BY total DESC ";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);


        return $this->render('report7', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    'sql_chart' => $sql_chart,
                    'date1' => $date1,
                    'date2' => $date2,
                    'main' => $main
        ]);
    }

    public function actionReport8() {

        $sql = ' SELECT st.sub_type_name as subtypename,
            (SELECT COUNT(r.sub_type_id) as cc FROM risk r	
            LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
            WHERE s.bdg_year="2559" and month(r.risk_date)=10 and st.id = r.sub_type_id )as "oct",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=11 and st.id = r.sub_type_id )as "nov",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=12 and st.id = r.sub_type_id )as "dece",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=1 and st.id = r.sub_type_id )as "jan",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=2 and st.id = r.sub_type_id )as "feb",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=3 and st.id = r.sub_type_id )as "mar",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=4 and st.id = r.sub_type_id )as "apr",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=5 and st.id = r.sub_type_id )as "may",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=6 and st.id = r.sub_type_id )as "june",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=7 and st.id = r.sub_type_id )as "july",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=8 and st.id = r.sub_type_id )as "aug",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=9 and st.id = r.sub_type_id )as "sep"
            FROM risk r
            LEFT OUTER JOIN sub_type st ON st.id = r.sub_type_id
            WHERE r.sub_type_id = "68"
            GROUP BY sub_type_name ';

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);


        $title = "ภาพรวมอัตรา ข้อร้องเรียน/ข้อเสนอแนะ ที่ได้รับการจัดการ ปีงบ 2559";
        $total1 = Yii::$app->db->createCommand("SELECT COUNT(sub_type_id) AS total FROM risk r
                                                                LEFT OUTER JOIN sub_type st ON st.id = r.type_id
                                                                WHERE r.sub_type_id = '68'
                                                                AND r.risk_date BETWEEN '2015-10-01' AND '2016-09-31'
                                                                AND r.status_id = '1' ")->queryScalar();
        $total2 = Yii::$app->db->createCommand("SELECT COUNT(sub_type_id) AS total FROM risk r
                                                                LEFT OUTER JOIN sub_type st ON st.id = r.type_id
                                                                WHERE r.sub_type_id = '68'
                                                                AND r.risk_date BETWEEN '2015-10-01' AND '2016-09-31'
                                                                AND r.status_id = '2' ")->queryScalar();

        return $this->render('report8', [
                    'dataProvider' => $dataProvider,
                    'title' => $title,
                    'total1' => $total1,
                    'total2' => $total2,
        ]);
    }

    public function actionReport9() {

        $sql = ' SELECT st.sub_type_name as subtypename,
            (SELECT COUNT(r.sub_type_id) as cc FROM risk r	
            LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
            WHERE s.bdg_year="2558" and month(r.risk_date)=10 and st.id = r.sub_type_id )as "oct",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=11 and st.id = r.sub_type_id )as "nov",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=12 and st.id = r.sub_type_id )as "dece",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=1 and st.id = r.sub_type_id )as "jan",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=2 and st.id = r.sub_type_id )as "feb",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=3 and st.id = r.sub_type_id )as "mar",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=4 and st.id = r.sub_type_id )as "apr",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=5 and st.id = r.sub_type_id )as "may",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=6 and st.id = r.sub_type_id )as "june",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=7 and st.id = r.sub_type_id )as "july",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=8 and st.id = r.sub_type_id )as "aug",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=9 and st.id = r.sub_type_id )as "sep"
            FROM risk r
            LEFT OUTER JOIN sub_type st ON st.id = r.sub_type_id
            WHERE r.sub_type_id = "68"
            GROUP BY sub_type_name ';

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);

        $title = "ภาพรวมอัตรา ข้อร้องเรียน/ข้อเสนอแนะ ที่ได้รับการจัดการ ปีงบ 2558";
        $total1 = Yii::$app->db->createCommand("SELECT COUNT(sub_type_id) AS total FROM risk r
                                                                LEFT OUTER JOIN sub_type st ON st.id = r.type_id
                                                                WHERE r.sub_type_id = '68'
                                                                AND r.risk_date BETWEEN '2015-10-01' AND '2016-09-31'
                                                                AND r.status_id = '1' ")->queryScalar();
        $total2 = Yii::$app->db->createCommand("SELECT COUNT(sub_type_id) AS total FROM risk r
                                                                LEFT OUTER JOIN sub_type st ON st.id = r.type_id
                                                                WHERE r.sub_type_id = '68'
                                                                AND r.risk_date BETWEEN '2015-10-01' AND '2016-09-31'
                                                                AND r.status_id = '2' ")->queryScalar();

        return $this->render('report9', [
                    'dataProvider' => $dataProvider,
                    'title' => $title,
                    'total1' => $total1,
                    'total2' => $total2,
        ]);
    }

    public function actionReport10() {

        $sql = ' SELECT st.sub_type_name as subtypename,
            (SELECT COUNT(r.sub_type_id) as cc FROM risk r	
            LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
            WHERE s.bdg_year="2560" and month(r.risk_date)=10 and st.id = r.sub_type_id )as "oct",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=11 and st.id = r.sub_type_id )as "nov",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=12 and st.id = r.sub_type_id )as "dece",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=1 and st.id = r.sub_type_id )as "jan",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=2 and st.id = r.sub_type_id )as "feb",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=3 and st.id = r.sub_type_id )as "mar",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=4 and st.id = r.sub_type_id )as "apr",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=5 and st.id = r.sub_type_id )as "may",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=6 and st.id = r.sub_type_id )as "june",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=7 and st.id = r.sub_type_id )as "july",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=8 and st.id = r.sub_type_id )as "aug",
		(SELECT COUNT(r.sub_type_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=9 and st.id = r.sub_type_id )as "sep"
            FROM risk r
            LEFT OUTER JOIN sub_type st ON st.id = r.sub_type_id
            WHERE r.sub_type_id = "68"
            GROUP BY sub_type_name ';

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);

        $title = "ภาพรวมอัตรา ข้อร้องเรียน/ข้อเสนอแนะ ที่ได้รับการจัดการ ปีงบ 2560";
        $total1 = Yii::$app->db->createCommand("SELECT COUNT(sub_type_id) AS total FROM risk r
                                                                LEFT OUTER JOIN sub_type st ON st.id = r.type_id
                                                                WHERE r.sub_type_id = '68'
                                                                AND r.risk_date BETWEEN '2016-10-01' AND '2017-09-31'
                                                                AND r.status_id = '1' ")->queryScalar();
        $total2 = Yii::$app->db->createCommand("SELECT COUNT(sub_type_id) AS total FROM risk r
                                                                LEFT OUTER JOIN sub_type st ON st.id = r.type_id
                                                                WHERE r.sub_type_id = '68'
                                                                AND r.risk_date BETWEEN '2016-10-01' AND '2017-09-31'
                                                                AND r.status_id = '2' ")->queryScalar();

        return $this->render('report10', [
                    'dataProvider' => $dataProvider,
                    'title' => $title,
                    'total1' => $total1,
                    'total2' => $total2,
        ]);
    }

    public function actionRefer() {

        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        $station = '';

        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
            $station = $_POST['station_name'];
        }

        $sql = " SELECT 
                r.station_name,
                LEFT(r.refer_date,10) AS refer_date,
                r.refer_time,
                r.hn,
                CONCAT(r.pname,'',r.fname,'  ',r.lname) AS fullname,
                r.memo,
                r.memoDiag,
                    CASE r.strength_id
			WHEN '01' THEN 'Resuscitation'
			WHEN '02' THEN 'Emergency'
			WHEN '03' THEN 'Urgency'
			WHEN '04' THEN 'Semi-urgency'
			WHEN '05' THEN 'Non-urgency'
                    ELSE '' END AS 'strength_id',
                    CASE r.loads_id
			WHEN '01' THEN 'รภ REFER'
			WHEN '02' THEN 'รภ REFER+พยาบาล'
			WHEN '03' THEN 'รภ REFER+พยาบาล+แพทย์'
			WHEN '04' THEN 'ผู้ป่วยเดินทางเอง'
                    ELSE '' END AS 'loads_id',
                r.pttype_id
                FROM referout r
                LEFT OUTER JOIN station s ON s.station_name = r.station_name
                WHERE r.refer_date BETWEEN '$date1' AND '$date2'  ";

        if ($station != '') {
            $sql = "SELECT 
                r.station_name,
                LEFT(r.refer_date,10) AS refer_date,
                r.refer_time,
                r.hn,
                CONCAT(r.pname,'',r.fname,'  ',r.lname) AS fullname,
                r.memo,
                r.memoDiag,
                    CASE r.strength_id
			WHEN '01' THEN 'Resuscitation'
			WHEN '02' THEN 'Emergency'
			WHEN '03' THEN 'Urgency'
			WHEN '04' THEN 'Semi-urgency'
			WHEN '05' THEN 'Non-urgency'
                    ELSE '' END AS 'strength_id',
                    CASE r.loads_id
			WHEN '01' THEN 'รภ REFER'
			WHEN '02' THEN 'รภ REFER+พยาบาล'
			WHEN '03' THEN 'รภ REFER+พยาบาล+แพทย์'
			WHEN '04' THEN 'ผู้ป่วยเดินทางเอง'
                    ELSE '' END AS 'loads_id',
                r.pttype_id
                FROM referout r
                LEFT OUTER JOIN station s ON s.station_id = r.station_id
                WHERE r.refer_date BETWEEN '$date1' AND '$date2' 
                AND r.station_id = $station ";
        }

        try {
            $rawData = \Yii::$app->db_refer->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);


        return $this->render('refer', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2,
                    'station' => $station,
        ]);
    }

    public function actionReport11() {

        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');

        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
        }

        $sql = "SELECT lr.location_name, 
                SUM(CASE WHEN r.status_id<>'' THEN 1 ELSE 0 END) AS total,
                SUM(CASE WHEN r.status_id=1 THEN 1 ELSE 0 END) AS status1,
                SUM(CASE WHEN r.status_id=2 THEN 1 ELSE 0 END) AS status2
                FROM risk r
                LEFT OUTER JOIN location_riks lr ON lr.id = r.location_riks_id
                WHERE risk_date between '$date1' and '$date2'
                GROUP BY lr.location_name
                UNION ALL
                SELECT 'รวม', 
                SUM(CASE WHEN r.status_id<>'' THEN 1 ELSE 0 END) AS total,
                SUM(CASE WHEN r.status_id=1 THEN 1 ELSE 0 END) AS status1,
                SUM(CASE WHEN r.status_id=2 THEN 1 ELSE 0 END) AS status2
                FROM risk r
                LEFT OUTER JOIN location_riks lr ON lr.id = r.location_riks_id
                WHERE risk_date between '$date1' and '$date2' ORDER BY total ASC ";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);

        return $this->render('report11', [

                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2,
        ]);
    }

    public function actionReport12() {

        //$date1 = date('Y-m-d');
        //$date2 = date('Y-m-d');
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        $clinic = '';

        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
            $clinic = $_POST['clinic'];
        }

        $sql = " select r.id,r.risk_date,r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
                    ,lr.location_name
                    ,r.risk_summary
                    ,l.level_e
                    ,ty.type_name as type
                    ,s.system_name as system
                    ,r.risk_review
                    ,st.status_name as status
            from risk r
            left outer join type_clinic cl on cl.id = r.type_clinic_id
            left outer join person p on p.id = r.person_id
            left outer join type ty on ty.id = r.type_id
            left outer join location_riks lr on lr.id = r.location_riks_id
            left outer join system s on s.id = r.system_id
            left outer join status st on st.id = r.status_id
            LEFT OUTER JOIN `level` l ON l.id = r.level_id
            WHERE r.level_id IN (7,8,9)
            AND risk_date between '$date1' and '$date2' ";

        if ($clinic != '') {
            $sql = "select r.id,r.risk_date,r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
                    ,lr.location_name
                    ,r.risk_summary
                    ,l.level_e
                    ,ty.type_name as type
                    ,s.system_name as system
                    ,r.risk_review
                    ,st.status_name as status
            from risk r
            left outer join type_clinic cl on cl.id = r.type_clinic_id
            left outer join person p on p.id = r.person_id
            left outer join type ty on ty.id = r.type_id
            left outer join location_riks lr on lr.id = r.location_riks_id
            left outer join system s on s.id = r.system_id
            left outer join status st on st.id = r.status_id
            LEFT OUTER JOIN `level` l ON l.id = r.level_id
            WHERE r.level_id IN (7,8,9)
            AND risk_date between '$date1' and '$date2' and r.type_clinic_id = $clinic ";
        }

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);

        return $this->render('report12', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2,
                    'clinic' => $clinic
        ]);
    }

    public function actionReport13() {

        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');

        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
        }

        $sql = "select r.id,r.risk_date,r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
            ,lr.location_name
            ,r.risk_summary
            ,le.level_e
            ,ty.type_name as type
            ,s.system_name as system
            ,r.risk_review
            ,st.status_name as status
            from risk r
left outer join person p on p.id = r.person_id
left outer join type ty on ty.id = r.type_id
left outer join location_riks lr on lr.id = r.location_riks_id
left outer join level le on le.id = r.level_id
left outer join system s on s.id = r.system_id
left outer join status st on st.id = r.status_id
WHERE type_id = '8'
AND sub_type_id = '68'
AND risk_date between '$date1' and '$date2'";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);


        return $this->render('report13', [

                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2,
        ]);
    }

    public function actionReport14() {

        $sql = " SELECT 'AB = NEAR MISS' as name,
'ไตรมาสที่ 1' as name1,
(SELECT COUNT(r.level_id) as cc FROM risk r	where risk_date BETWEEN '2015-10-01' AND '2015-12-31' AND r.level_id IN (1,2) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2015-10-01' AND '2015-12-31' AND rr.level_id IN (1,2) ) as 'TM1',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2016-01-01' AND '2016-03-31' AND r.level_id IN (1,2) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-01-01' AND '2016-03-31' AND rr.level_id IN (1,2) ) as 'TM2',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2016-04-01' AND '2016-06-31' AND r.level_id IN (1,2) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-04-01' AND '2016-06-31' AND rr.level_id IN (1,2) ) as 'TM3',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2016-07-01' AND '2016-09-31' AND r.level_id IN (1,2) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-07-01' AND '2016-09-31' AND rr.level_id IN (1,2) ) as 'TM4'
FROM risk r
LEFT OUTER JOIN level le ON le.id = r.level_id
GROUP BY NAME

UNION ALL

SELECT 'CD = LOW' as name,
'ไตรมาสที่ 2' as name1,
(SELECT COUNT(r.level_id) as cc FROM risk r	where risk_date BETWEEN '2015-10-01' AND '2015-12-31' AND r.level_id IN (3,4) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2015-10-01' AND '2015-12-31' AND rr.level_id IN (3,4) ) as 'TM1',


(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2016-01-01' AND '2016-03-31' AND r.level_id IN (3,4) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-01-01' AND '2016-03-31' AND rr.level_id IN (3,4) ) as 'TM2',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2016-04-01' AND '2016-06-31' AND r.level_id IN (3,4) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-04-01' AND '2016-06-31' AND rr.level_id IN (3,4) ) as 'TM3',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2016-07-01' AND '2016-09-31' AND r.level_id IN (3,4) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-07-01' AND '2016-09-31' AND rr.level_id IN (3,4) ) as 'TM4'
FROM risk r
LEFT OUTER JOIN level le ON le.id = r.level_id
GROUP BY NAME
UNION ALL
SELECT 'EF = MODERRATE' as name,
'ไตรมาสที่ 3' as name1,
(SELECT COUNT(r.level_id) as cc FROM risk r	where risk_date BETWEEN '2015-10-01' AND '2015-12-31' AND r.level_id IN (5,6) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2015-10-01' AND '2015-12-31' AND rr.level_id IN (5,6) ) as 'TM1',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2016-01-01' AND '2016-03-31' AND r.level_id IN (5,6) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-01-01' AND '2016-03-31' AND rr.level_id IN (5,6) ) as 'TM2',


(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2016-04-01' AND '2016-06-31' AND r.level_id IN (5,6) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-04-01' AND '2016-06-31' AND rr.level_id IN (5,6) ) as 'TM3',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2016-07-01' AND '2016-09-31' AND r.level_id IN (5,6) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-07-01' AND '2016-09-31' AND rr.level_id IN (5,6) ) as 'TM4'
FROM risk r
LEFT OUTER JOIN level le ON le.id = r.level_id
GROUP BY NAME
UNION ALL
SELECT 'GHI = HIGH' as name,
'ไตรมาสที่ 4 ' as name1,
(SELECT COUNT(r.level_id) as cc FROM risk r	where risk_date BETWEEN '2015-10-01' AND '2015-12-31' AND r.level_id IN (7,8,9) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2015-10-01' AND '2015-12-31' AND rr.level_id IN (7,8,9) ) as 'TM1',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2016-01-01' AND '2016-03-31' AND r.level_id IN (7,8,9) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-01-01' AND '2016-03-31' AND rr.level_id IN (7,8,9) ) as 'TM2',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2016-04-01' AND '2016-06-31' AND r.level_id IN (7,8,9) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-04-01' AND '2016-06-31' AND rr.level_id IN (7,8,9) ) as 'TM3',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2016-07-01' AND '2016-09-31' AND r.level_id IN (7,8,9) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-07-01' AND '2016-09-31' AND rr.level_id IN (7,8,9) ) as 'TM4'
FROM risk r
LEFT OUTER JOIN level le ON le.id = r.level_id
GROUP BY NAME
 ";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);

        $rawData = Yii::$app->db->createCommand($sql)->queryAll();



        $sql_level = " SELECT 'ไตรมาสที่ 1' as NAME,

(SELECT COUNT(r.level_id) as cc FROM risk r	where risk_date BETWEEN '2015-10-01' AND '2015-12-31' AND r.level_id IN (1,2) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2015-10-01' AND '2015-12-31' AND rr.level_id IN (1,2) ) as 'NEAR MISS',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2015-10-01' AND '2015-12-31' AND r.level_id IN (3,4) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2015-10-01' AND '2015-12-31' AND rr.level_id IN (3,4) ) as 'LOW',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2015-10-01' AND '2015-12-31' AND r.level_id IN (5,6) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2015-10-01' AND '2015-12-31' AND rr.level_id IN (5,6) ) as 'MODERRATE',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2015-10-01' AND '2015-12-31' AND r.level_id IN (7,8,9) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2015-10-01' AND '2015-12-31' AND rr.level_id IN (7,8,9) ) as 'HIGH'
FROM risk r
LEFT OUTER JOIN level le ON le.id = r.level_id
GROUP BY NAME

UNION ALL

SELECT 'ไตรมาสที่ 2' as NAME,
(SELECT COUNT(r.level_id) as cc FROM risk r	where risk_date BETWEEN '2016-01-01' AND '2016-03-31' AND r.level_id IN (1,2) ) 
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-01-01' AND '2016-03-31' AND rr.level_id IN (1,2) ) as 'NEAR MISS',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2016-01-01' AND '2016-03-31' AND r.level_id IN (3,4) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-01-01' AND '2016-03-31' AND rr.level_id IN (3,4) ) as 'LOW',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2016-01-01' AND '2016-03-31' AND r.level_id IN (5,6) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-01-01' AND '2016-03-31' AND rr.level_id IN (5,6) ) as 'MODERRATE',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2016-01-01' AND '2016-03-31' AND r.level_id IN (7,8,9) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-01-01' AND '2016-03-31' AND rr.level_id IN (7,8,9) ) as 'HIGH'
FROM risk r
LEFT OUTER JOIN level le ON le.id = r.level_id
GROUP BY NAME

UNION ALL

SELECT 'ไตรมาสที่ 3' as NAME,
(SELECT COUNT(r.level_id) as cc FROM risk r	where risk_date BETWEEN '2016-04-01' AND '2016-06-31' AND r.level_id IN (1,2) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-04-01' AND '2016-06-31' AND rr.level_id IN (1,2) ) as 'NEAR MISS',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2016-04-01' AND '2016-06-31' AND r.level_id IN (3,4) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-04-01' AND '2016-06-31' AND rr.level_id IN (3,4)) as 'LOW',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2016-04-01' AND '2016-06-31' AND r.level_id IN (5,6) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-04-01' AND '2016-06-31' AND rr.level_id IN (5,6)) as 'MODERRATE',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2016-04-01' AND '2016-06-31' AND r.level_id IN (7,8,9) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-04-01' AND '2016-06-31' AND rr.level_id IN (7,8,9) ) as 'HIGH'
FROM risk r
LEFT OUTER JOIN level le ON le.id = r.level_id
GROUP BY NAME

UNION ALL

SELECT 'ไตรมาสที่ 4' as NAME,
(SELECT COUNT(r.level_id) as cc FROM risk r	where risk_date BETWEEN '2016-07-01' AND '2016-09-31' AND r.level_id IN (1,2) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-07-01' AND '2016-09-31' AND rr.level_id IN (1,2) ) as 'NEAR MISS',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2016-07-01' AND '2016-09-31' AND r.level_id IN (3,4) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-07-01' AND '2016-09-31' AND rr.level_id IN (3,4) ) as 'LOW',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2016-07-01' AND '2016-09-31' AND r.level_id IN (5,6) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-07-01' AND '2016-09-31' AND rr.level_id IN (5,6) ) as 'MODERRATE',

(SELECT COUNT(r.level_id) as cc FROM risk r where risk_date BETWEEN '2016-07-01' AND '2016-09-31' AND r.level_id IN (7,8,9) )
+
(SELECT COUNT(rr.level_id) as cc FROM risk_med rr	where risk_date BETWEEN '2016-07-01' AND '2016-09-31' AND rr.level_id IN (7,8,9) ) as 'HIGH'
FROM risk r
LEFT OUTER JOIN level le ON le.id = r.level_id
GROUP BY NAME ";

        $rawData = Yii::$app->db->createCommand($sql_level)->queryAll();

        $main_data1 = [];
        $main_data2 = [];
        $main_data3 = [];
        $main_data4 = [];

        foreach ($rawData as $data1) {
            $main_data1[] = [
                'name' => $data1['NAME'],
                'y' => $data1['NEAR MISS'] * 1,
            ];
        }
        foreach ($rawData as $data2) {
            $main_data2[] = [
                'name' => $data2['NAME'],
                'y' => $data2['LOW'] * 1,
            ];
        }
        foreach ($rawData as $data3) {
            $main_data3[] = [
                'name' => $data3['NAME'],
                'y' => $data3['MODERRATE'] * 1,
            ];
        }
        foreach ($rawData as $data4) {
            $main_data4[] = [
                'name' => $data4['NAME'],
                'y' => $data4['HIGH'] * 1,
            ];
        }

        $main1 = json_encode($main_data1);
        $main2 = json_encode($main_data2);
        $main3 = json_encode($main_data3);
        $main4 = json_encode($main_data4);

        return $this->render('report14', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    'sql_level' => $sql_level,
                    'main1' => $main1,
                    'main2' => $main2,
                    'main3' => $main3,
                    'main4' => $main4,
        ]);
    }

    public function actionReport15() {

        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');

        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
        }

        $sql_clinic = " SELECT ty.sub_type_name,COUNT(r.sub_type_id) as type
FROM risk r
LEFT OUTER JOIN sub_type ty ON ty.id = r.sub_type_id
LEFT OUTER JOIN type_clinic tyc ON tyc.id = r.type_clinic_id
WHERE r.type_clinic_id = '1'
AND r.risk_date between '$date1' and '$date2'
GROUP BY ty.sub_type_name
UNION ALL
SELECT tym.sub_med_type_name,COUNT(rr.sub_med_type_id) as type
FROM risk_med rr 
LEFT OUTER JOIN sub_med_type tym ON tym.id = rr.sub_med_type_id
WHERE rr.risk_date between '$date1' and '$date2'
AND rr.type_clinic_id = '1'
GROUP BY tym.sub_med_type_name
ORDER BY type DESC  LIMIT 15 ";

        try {
            $rawData1 = \Yii::$app->db->createCommand($sql_clinic)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider1 = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData1,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);


        $sql_nonclinic = " SELECT ty.sub_type_name,COUNT(r.sub_type_id) as type
FROM risk r
LEFT OUTER JOIN sub_type ty ON ty.id = r.sub_type_id
LEFT OUTER JOIN type_clinic tyc ON tyc.id = r.type_clinic_id
WHERE r.type_clinic_id = '2'
AND r.risk_date between '$date1' and '$date2'
GROUP BY ty.sub_type_name
UNION ALL
SELECT tym.sub_med_type_name,COUNT(rr.sub_med_type_id) as type
FROM risk_med rr 
LEFT OUTER JOIN sub_med_type tym ON tym.id = rr.sub_med_type_id
WHERE rr.risk_date between '$date1' and '$date2'
AND rr.type_clinic_id = '2'
GROUP BY tym.sub_med_type_name
ORDER BY type DESC LIMIT 15 ";

        try {
            $rawData2 = \Yii::$app->db->createCommand($sql_nonclinic)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider2 = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData2,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);


        return $this->render('report15', [
                    'dataProvider1' => $dataProvider1,
                    'dataProvider2' => $dataProvider2,
                    'rawData1' => $rawData1,
                    'rawData2' => $rawData2,
                    'sql_clinic' => $sql_clinic,
                    'sql_nonclinic' => $sql_nonclinic,
                    'date1' => $date1,
                    'date2' => $date2,
        ]);
    }

    public function actionReport16() {

        //$date1 = date('Y-m-d');
        //$date2 = date('Y-m-d');
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        $person = '';

        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
            $person = $_POST['person'];
        }

        $sql = " SELECT r.id,r.risk_date,p.person_type,CONCAT(r.pname,'',r.fname,'  ',lname) as fullname,lr.location_name,
r.risk_summary,ty.type_name,sb.sub_type_name,st.status_name,r.risk_review
FROM risk r
LEFT OUTER JOIN person p ON p.id = r.person_id
LEFT OUTER JOIN location_riks lr ON lr.id = r.location_riks_id
LEFT OUTER JOIN type ty ON ty.id = r.type_id
LEFT OUTER JOIN sub_type sb ON sb.id = r.sub_type_id
LEFT OUTER JOIN `status` st ON st.id = r.status_id
WHERE risk_date BETWEEN '$date1' AND '$date2'
UNION ALL
SELECT r.id,r.risk_date,p.person_type,CONCAT(r.pname,'',r.fname,'  ',lname) as fullname,lr.location_name,
r.risk_summary,ty.type_name,sb.sub_med_type_name,st.status_name,r.risk_review
FROM risk_med r
LEFT OUTER JOIN person p ON p.id = r.person_id
LEFT OUTER JOIN location_riks lr ON lr.id = r.location_riks_id
LEFT OUTER JOIN type_med ty ON ty.id = r.type_med_id
LEFT OUTER JOIN sub_med_type sb ON sb.id = r.sub_med_type_id
LEFT OUTER JOIN `status` st ON st.id = r.status_id
WHERE risk_date BETWEEN '$date1' AND '$date2' ";

        if ($person != '') {
            $sql = " SELECT r.id,r.risk_date,p.person_type,CONCAT(r.pname,'',r.fname,'  ',lname) as fullname,lr.location_name,
r.risk_summary,ty.type_name,sb.sub_type_name,st.status_name,r.risk_review
FROM risk r
LEFT OUTER JOIN person p ON p.id = r.person_id
LEFT OUTER JOIN location_riks lr ON lr.id = r.location_riks_id
LEFT OUTER JOIN type ty ON ty.id = r.type_id
LEFT OUTER JOIN sub_type sb ON sb.id = r.sub_type_id
LEFT OUTER JOIN `status` st ON st.id = r.status_id
WHERE risk_date BETWEEN '$date1' AND '$date2' and r.person_id = $person
UNION ALL
SELECT r.id,r.risk_date,p.person_type,CONCAT(r.pname,'',r.fname,'  ',lname) as fullname,lr.location_name,
r.risk_summary,ty.type_name,sb.sub_med_type_name,st.status_name,r.risk_review
FROM risk_med r
LEFT OUTER JOIN person p ON p.id = r.person_id
LEFT OUTER JOIN location_riks lr ON lr.id = r.location_riks_id
LEFT OUTER JOIN type_med ty ON ty.id = r.type_med_id
LEFT OUTER JOIN sub_med_type sb ON sb.id = r.sub_med_type_id
LEFT OUTER JOIN `status` st ON st.id = r.status_id
WHERE risk_date BETWEEN '$date1' AND '$date2' and r.person_id = $person ";
        }

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);

        return $this->render('report16', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2,
                    'person' => $person
        ]);
    }

}
