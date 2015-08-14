<?php

namespace frontend\controllers;

use yii;

class ReportController extends \yii\web\Controller {

    public $enableCsrfValidation = false;

    public function actionReport() {

        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');


        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
        }

        $sql = "select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
            ,lr.location_name
            ,r.risk_summary
            ,le.level_e
            ,ty.type_name as type
            ,s.system_name as system
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


        return $this->render('index', [

                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2
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

        $sql = "select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
            ,lr.location_name
            ,r.risk_summary
            ,le.level_e
            ,ty.type_name as type
            ,s.system_name as system
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
            $sql = "select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
            ,lr.location_name
            ,r.risk_summary
            ,le.level_e
            ,ty.type_name as type
            ,s.system_name as system
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
WHERE r.risk_date BETWEEN '$date1' and '$date2' ";


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

        $date1 = date('2014-01-01');
        $date2 = date('Y-m-d');

        /* if (Yii::$app->request->isPost) {
          $date1 = $_POST['date1'];
          $date2 = $_POST['date2'];
          } */

        $sql = "select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
            ,lr.location_name
            ,r.risk_summary
            ,le.level_e
            ,ty.type_name as type
            ,s.system_name as system
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
        ]);
    }

    public function actionReport4() {

        $date1 = date('2014-01-01');
        $date2 = date('Y-m-d');

        /* if (Yii::$app->request->isPost) {
          $date1 = $_POST['date1'];
          $date2 = $_POST['date2'];
          } */

        $sql = "select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
            ,lr.location_name
            ,r.risk_summary
            ,le.level_e
            ,ty.type_name as type
            ,s.system_name as system
            ,st.status_name as status
            from risk r
left outer join person p on p.id = r.person_id
left outer join type ty on ty.id = r.type_id
left outer join location_riks lr on lr.id = r.location_riks_id
left outer join level le on le.id = r.level_id
left outer join system s on s.id = r.system_id
left outer join status st on st.id = r.status_id
where risk_date between '$date1' and '$date2'
and r.level_id = '9'";

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

        $sql = "select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
            ,lr.location_name
            ,r.risk_summary
            ,le.level_e
            ,ty.type_name as type
            ,s.system_name as system
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

    public function actionReport20() {

        return $this->render('report20');
    }

}
