<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\components\AccessRule;
use common\models\User;

class MedController extends \yii\web\Controller {

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
                'only' => ['report', 'report5', 'report3', 'report4'],
                'ruleConfig' => [
                    'class' => AccessRule::className()
                ],
                'rules' => [
                    [
                        'actions' => ['report', 'report5', 'report3', 'report4'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_USER,
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

        $sql = " SELECT location_riks_id,location_name,SUM(total) AS total
                    FROM(
                    SELECT rd.location_riks_id,l.location_name,count(l.location_name) AS total
                    FROM risk_med rd
                    INNER JOIN location_riks l ON l.id = rd.location_riks_id
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
                'drilldown' => $data['location_riks_id']
            ];
        }
        $main = json_encode($main_data);
        //echo $main;
        /* $sql = "SELECT r.location_riks_id,l.location_name,
          SUM(CASE WHEN r.level_id='1' THEN 1 ELSE 0 END)AS A,
          SUM(CASE WHEN r.level_id='2' THEN 1 ELSE 0 END)AS B,
          SUM(CASE WHEN r.level_id='3' THEN 1 ELSE 0 END)AS C,
          SUM(CASE WHEN r.level_id='4' THEN 1 ELSE 0 END)AS D,
          SUM(CASE WHEN r.level_id='5' THEN 1 ELSE 0 END)AS E,
          SUM(CASE WHEN r.level_id='6' THEN 1 ELSE 0 END)AS F,
          SUM(CASE WHEN r.level_id='7' THEN 1 ELSE 0 END)AS G,
          SUM(CASE WHEN r.level_id='8' THEN 1 ELSE 0 END)AS H,
          SUM(CASE WHEN r.level_id='9' THEN 1 ELSE 0 END)AS I
          FROM rm.risk r
          INNER JOIN rm.location_riks l ON l.id = r.location_riks_id
          GROUP BY r.location_riks_id"; */
        $sql = " SELECT location_riks_id,location_name,SUM(A) AS A,SUM(B) AS B,SUM(C) AS C,SUM(D) AS D,SUM(E) AS E,SUM(F) AS F,SUM(G) AS G,SUM(H) AS H,SUM(I) AS I
FROM(SELECT rd.location_riks_id,l.location_name,
                    SUM(CASE WHEN rd.level_id='1' THEN 1 ELSE 0 END)AS A,
                    SUM(CASE WHEN rd.level_id='2' THEN 1 ELSE 0 END)AS B,
                    SUM(CASE WHEN rd.level_id='3' THEN 1 ELSE 0 END)AS C,
                    SUM(CASE WHEN rd.level_id='4' THEN 1 ELSE 0 END)AS D,
                    SUM(CASE WHEN rd.level_id='5' THEN 1 ELSE 0 END)AS E,
                    SUM(CASE WHEN rd.level_id='6' THEN 1 ELSE 0 END)AS F,
                    SUM(CASE WHEN rd.level_id='7' THEN 1 ELSE 0 END)AS G,
                    SUM(CASE WHEN rd.level_id='8' THEN 1 ELSE 0 END)AS H,
                    SUM(CASE WHEN rd.level_id='9' THEN 1 ELSE 0 END)AS I
                    FROM risk_med rd
                    INNER JOIN location_riks l ON l.id = rd.location_riks_id
                    GROUP BY rd.location_riks_id
) AS tb
GROUP BY location_riks_id ";
        $rawData = Yii::$app->db->createCommand($sql)->queryAll();
        $sub_data = [];
        foreach ($rawData as $data) {
            $sub_data[] = [
                'id' => $data['location_riks_id'],
                'name' => $data['location_name'],
                'data' => [[
                'A', $data['A'] * 1], [
                        'B', $data['B'] * 1], [
                        'C', $data['C'] * 1], [
                        'D', $data['D'] * 1], [
                        'E', $data['E'] * 1], [
                        'F', $data['F'] * 1], [
                        'G', $data['G'] * 1], [
                        'H', $data['H'] * 1], [
                        'I', $data['I'] * 1]]
            ];
        }
        $sub = json_encode($sub_data);



        $sql_level = "SELECT level,SUM(total) as total
                            FROM(
                                SELECT l.level_e as level,count(l.level_name) as total FROM risk_med rd
                                LEFT OUTER JOIN level l ON l.id = rd.level_id
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
                    'sql' => $sql,
                    'main' => $main,
                    'sub' => $sub,
                    'sql_level' => $sql_level,
                    'main_level' => $main_level,
        ]);
    }

    public function actionReport1() {
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        $location = '';

        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
            $location = $_POST['location'];
        }

        $sql = "select rd.id,rd.hn,concat(rd.pname,rd.fname,'  ',rd.lname) as fullname
            ,lr.location_name
            ,rd.risk_summary
            ,le.level_e
            ,ty.type_name as type
            ,s.system_name as system
            ,rd.risk_review
            ,st.status_name as status
            from risk_med rd
            left outer join person p on p.id = rd.person_id
            left outer join type_med ty on ty.id = rd.type_med_id
            left outer join location_riks lr on lr.id = rd.location_riks_id
            left outer join level le on le.id = rd.level_id
            left outer join system s on s.id = rd.system_id
            left outer join status st on st.id = rd.status_id
            where risk_date between '$date1' and '$date2'";

        if ($location != '') {
            $sql = "select rd.id,rd.hn,concat(rd.pname,rd.fname,'  ',rd.lname) as fullname
            ,lr.location_name
            ,rd.risk_summary
            ,le.level_e
            ,ty.type_name as type
            ,s.system_name as system
            ,rd.risk_review
            ,st.status_name as status
            from risk_med rd
            left outer join person p on p.id = rd.person_id
            left outer join type_med ty on ty.id = rd.type_med_id
            left outer join location_riks lr on lr.id = rd.location_riks_id
            left outer join level le on le.id = rd.level_id
            left outer join system s on s.id = rd.system_id
            left outer join status st on st.id = rd.status_id
            where risk_date between '$date1' and '$date2'  and rd.location_riks_id = $location";
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
                SUM(CASE WHEN rd.level_id='1' THEN 1 ELSE 0 END)AS A,
                SUM(CASE WHEN rd.level_id='2' THEN 1 ELSE 0 END)AS B,
                SUM(CASE WHEN rd.level_id='3' THEN 1 ELSE 0 END)AS C,
                SUM(CASE WHEN rd.level_id='4' THEN 1 ELSE 0 END)AS D,
                SUM(CASE WHEN rd.level_id='5' THEN 1 ELSE 0 END)AS E,
                SUM(CASE WHEN rd.level_id='6' THEN 1 ELSE 0 END)AS F,
                SUM(CASE WHEN rd.level_id='7' THEN 1 ELSE 0 END)AS G,
                SUM(CASE WHEN rd.level_id='8' THEN 1 ELSE 0 END)AS H,
                SUM(CASE WHEN rd.level_id='9' THEN 1 ELSE 0 END)AS I,
                SUM(CASE WHEN rd.level_id<>'' THEN 1 ELSE 0 END)AS TOTAL
                FROM risk_med rd
                INNER JOIN location_riks l ON l.id = rd.location_riks_id
                WHERE rd.risk_date BETWEEN '$date1' and '$date2'
                GROUP BY rd.location_riks_id
                UNION ALL
                SELECT 'TOTAL' AS location,
                SUM(CASE WHEN rd.level_id='1' THEN 1 ELSE 0 END)AS A,
                SUM(CASE WHEN rd.level_id='2' THEN 1 ELSE 0 END)AS B,
                SUM(CASE WHEN rd.level_id='3' THEN 1 ELSE 0 END)AS C,
                SUM(CASE WHEN rd.level_id='4' THEN 1 ELSE 0 END)AS D,
                SUM(CASE WHEN rd.level_id='5' THEN 1 ELSE 0 END)AS E,
                SUM(CASE WHEN rd.level_id='6' THEN 1 ELSE 0 END)AS F,
                SUM(CASE WHEN rd.level_id='7' THEN 1 ELSE 0 END)AS G,
                SUM(CASE WHEN rd.level_id='8' THEN 1 ELSE 0 END)AS H,
                SUM(CASE WHEN rd.level_id='9' THEN 1 ELSE 0 END)AS I,
                SUM(CASE WHEN rd.level_id<>'' THEN 1 ELSE 0 END)AS TOTAL
                FROM risk_med rd
                INNER JOIN location_riks l ON l.id = rd.location_riks_id
                WHERE rd.risk_date BETWEEN '$date1' and '$date2'
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

        $sql = " select rd.id,rd.hn,concat(rd.pname,rd.fname,'  ',rd.lname) as fullname
            ,lr.location_name
            ,rd.risk_summary
            ,le.level_e
            ,ty.type_name as type
            ,s.system_name as system
            ,rd.risk_review
            ,st.status_name as status
            from risk_med rd
            left outer join person p on p.id = rd.person_id
            left outer join type_med ty on ty.id = rd.type_med_id
            left outer join location_riks lr on lr.id = rd.location_riks_id
            left outer join level le on le.id = rd.level_id
            left outer join system s on s.id = rd.system_id
            left outer join status st on st.id = rd.status_id
            where risk_date between '$date1' and '$date2'
            and rd.status_id = '1' ";

        if ($location != '') {
            $sql = "select rd.id,rd.hn,concat(rd.pname,rd.fname,'  ',rd.lname) as fullname
            ,lr.location_name
            ,rd.risk_summary
            ,le.level_e
            ,ty.type_name as type
            ,s.system_name as system
            ,rd.risk_review
            ,st.status_name as status
            from risk_med rd
            left outer join person p on p.id = rd.person_id
            left outer join type_med ty on ty.id = rd.type_med_id
            left outer join location_riks lr on lr.id = rd.location_riks_id
            left outer join level le on le.id = rd.level_id
            left outer join system s on s.id = rd.system_id
            left outer join status st on st.id = rd.status_id
            where risk_date between '$date1' and '$date2'
            and rd.status_id = '1'
            and rd.location_riks_id = $location
            and rd.status_id = '1'";
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

        $sql = "select rd.id,rd.hn,concat(rd.pname,rd.fname,'  ',rd.lname) as fullname
            ,lr.location_name
            ,rd.risk_summary
            ,le.level_e
            ,ty.type_name as type
            ,s.system_name as system
            ,rd.risk_review
            ,st.status_name as status
            from risk_med rd
left outer join person p on p.id = rd.person_id
left outer join type_med ty on ty.id = rd.type_med_id
left outer join location_riks lr on lr.id = rd.location_riks_id
left outer join level le on le.id = rd.level_id
left outer join system s on s.id = rd.system_id
left outer join status st on st.id = rd.status_id
where risk_date between '$date1' and '$date2'
and rd.level_id in ('7','8','9') ";

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

        $sql = "select rd.id,rd.hn,concat(rd.pname,rd.fname,'  ',rd.lname) as fullname
            ,lr.location_name
            ,rd.risk_summary
            ,le.level_e
            ,ty.type_name as type
            ,s.system_name as system
            ,rd.risk_review
            ,st.status_name as status
            from risk_med rd
left outer join person p on p.id = rd.person_id
left outer join type ty on ty.id = rd.type_med_id
left outer join location_riks lr on lr.id = rd.location_riks_id
left outer join level le on le.id = rd.level_id
left outer join system s on s.id = rd.system_id
left outer join status st on st.id = rd.status_id
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

    public function actionReport7() {

        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');

        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
        }

        $sql = " SELECT lr.location_name,COUNT(r.location_report_id) AS total FROM risk_med r
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
                    'date1' => $date1,
                    'date2' => $date2,
        ]);
    }

    public function actionReport8() {

        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');

        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
        }

        $sql = "SELECT 'DOC' as 'Department',
sum(case WHEN type_med_id ='1' AND location_riks_id = '1' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Administrator Error' ,
sum(case WHEN type_med_id ='2' AND location_riks_id = '1' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Dispensing Error' ,
sum(case WHEN type_med_id ='3' AND location_riks_id = '1' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Proscribing Error' ,
sum(case WHEN type_med_id ='4' AND location_riks_id = '1' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Processing Error' 
FROM risk_med
UNION ALL
SELECT 'DENT'as 'Department',
sum(case WHEN type_med_id ='1' AND location_riks_id = '6' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Administrator Error' ,
sum(case WHEN type_med_id ='2' AND location_riks_id = '6' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Dispensing Error' ,
sum(case WHEN type_med_id ='3' AND location_riks_id = '6' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Proscribing Error' ,
sum(case WHEN type_med_id ='4' AND location_riks_id = '6' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Processing Error' 
FROM risk_med
UNION ALL
SELECT 'PHAR' as 'Department',
sum(case WHEN type_med_id ='1' AND location_riks_id = '3' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Administrator Error' ,
sum(case WHEN type_med_id ='2' AND location_riks_id = '3' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Dispensing Error' ,
sum(case WHEN type_med_id ='3' AND location_riks_id = '3' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Proscribing Error' ,
sum(case WHEN type_med_id ='4' AND location_riks_id = '3' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Processing Error' 
FROM risk_med
UNION ALL
SELECT 'OPD' as 'Department',
sum(case WHEN type_med_id ='1' AND location_riks_id = '7' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Administrator Error' ,
sum(case WHEN type_med_id ='2' AND location_riks_id = '7' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Dispensing Error' ,
sum(case WHEN type_med_id ='3' AND location_riks_id = '7' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Proscribing Error' ,
sum(case WHEN type_med_id ='4' AND location_riks_id = '7' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Processing Error' 
FROM risk_med
UNION ALL
SELECT 'IPD'as 'Department',
sum(case WHEN type_med_id ='1' AND location_riks_id = '8' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Administrator Error' ,
sum(case WHEN type_med_id ='2' AND location_riks_id = '8' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Dispensing Error' ,
sum(case WHEN type_med_id ='3' AND location_riks_id = '8' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Proscribing Error' ,
sum(case WHEN type_med_id ='4' AND location_riks_id = '8' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Processing Error' 
FROM risk_med
UNION ALL
SELECT 'ER'as 'Department',
sum(case WHEN type_med_id ='1' AND location_riks_id = '2' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Administrator Error' ,
sum(case WHEN type_med_id ='2' AND location_riks_id = '2' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Dispensing Error' ,
sum(case WHEN type_med_id ='3' AND location_riks_id = '2' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Proscribing Error' ,
sum(case WHEN type_med_id ='4' AND location_riks_id = '2' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Processing Error' 
FROM risk_med
UNION ALL
SELECT 'LR/OR'as 'Department',
sum(case WHEN type_med_id ='1' AND location_riks_id = '10' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Administrator Error' ,
sum(case WHEN type_med_id ='2' AND location_riks_id = '10' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Dispensing Error' ,
sum(case WHEN type_med_id ='3' AND location_riks_id = '10' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Proscribing Error' ,
sum(case WHEN type_med_id ='4' AND location_riks_id = '10' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Processing Error' 
FROM risk_med
UNION ALL
SELECT 'VECH'as 'Department',
sum(case WHEN type_med_id ='1' AND location_riks_id = '9' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Administrator Error' ,
sum(case WHEN type_med_id ='2' AND location_riks_id = '9' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Dispensing Error' ,
sum(case WHEN type_med_id ='3' AND location_riks_id = '9' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Proscribing Error' ,
sum(case WHEN type_med_id ='4' AND location_riks_id = '9' AND risk_date between '$date1' and '$date2' then 1 ELSE 0 end ) as 'Processing Error' 
FROM risk_med";


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


        return $this->render('report8', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2,
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

}
