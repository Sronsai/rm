<?php

namespace frontend\controllers;

use yii;
use yii\web\Controller;
use frontend\controllers\TypesController;

class TypesController extends controller {

    public function actionTypes1() {

        ////////////////////// sql ระดับความรุนแรง ///////////////////////
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
                WHERE type_id = '1'
                GROUP BY r.location_riks_id
                UNION ALL
                SELECT 'รวม' AS location,
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
                WHERE type_id = '1'";

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

        ///////////////////////// sql การทบทวน ////////////////////////
        $sql1 = "SELECT s.status_name,COUNT(r.status_id) AS status_id FROM risk r
                LEFT OUTER JOIN status s ON s.id = r.status_id
                WHERE r.type_id = '1'
                GROUP BY s.status_name";

        try {
            $rawData1 = \Yii::$app->db->createCommand($sql1)->queryAll();
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

        ///////////////////////// sql แยกหน่วยงาน+ประเภทย่อย /////////////////
        $sql3 = "SELECT l.location_name,t.type_name,st.sub_type_name,COUNT(st.sub_type_name) AS total FROM risk r
                LEFT OUTER JOIN location_riks l ON l.id = r.location_riks_id
                LEFT OUTER JOIN type t ON t.id = r.type_id
                LEFT OUTER JOIN sub_type st ON st.id = r.sub_type_id
                WHERE r.type_id = '1'
                GROUP BY l.location_name,st.sub_type_name
                ORDER BY total DESC";

        try {
            $rawData3 = \Yii::$app->db->createCommand($sql3)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider3 = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData3,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);



        ///////////////////////// sql แยกแผนกกราฟแท่ง /////////////////
        $sql2 = "SELECT l.location_name,COUNT(r.type_id) AS type_id FROM risk r
                LEFT OUTER JOIN location_riks l ON l.id = r.location_riks_id
                WHERE r.type_id = '1'
                GROUP BY l.location_name";

        $rawData2 = Yii::$app->db->createCommand($sql2)->queryAll();
        $main_data = [];
        foreach ($rawData2 as $data) {
            $main_data[] = [
                'name' => $data['location_name'],
                'y' => $data['type_id'] * 1,
                    //'drilldown' => $data['location_riks_id']
            ];
        }
        $main = json_encode($main_data);

        return $this->render('types1', [
                    // sql ระดับความรุนแรง
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    // sql การทบทวน
                    'dataProvider1' => $dataProvider1,
                    'rawData1' => $rawData1,
                    'sql1' => $sql1,
                    // sql หน่วยงาน+ประเภทย่อย
                    'dataProvider3' => $dataProvider3,
                    'rawData3' => $rawData3,
                    'sql3' => $sql3,
                    // sql แยกแผนกกราฟแท่ง
                    'sql2' => $sql2,
                    'rawData2' => $rawData2,
                    'main' => $main,
        ]);
    }

    public function actionTypes2() {

        ////////////////////// sql ระดับความรุนแรง ///////////////////////
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
                WHERE type_id = '2'
                GROUP BY r.location_riks_id
                UNION ALL
                SELECT 'รวม' AS location,
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
                WHERE type_id = '2'";

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

        ///////////////////////// sql การทบทวน ////////////////////////
        $sql1 = "SELECT s.status_name,COUNT(r.status_id) AS status_id FROM risk r
                LEFT OUTER JOIN status s ON s.id = r.status_id
                WHERE r.type_id = '2'
                GROUP BY s.status_name";

        try {
            $rawData1 = \Yii::$app->db->createCommand($sql1)->queryAll();
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

        ///////////////////////// sql แยกหน่วยงาน+ประเภทย่อย /////////////////
        $sql3 = "SELECT l.location_name,t.type_name,st.sub_type_name,COUNT(st.sub_type_name) AS total FROM risk r
                LEFT OUTER JOIN location_riks l ON l.id = r.location_riks_id
                LEFT OUTER JOIN type t ON t.id = r.type_id
                LEFT OUTER JOIN sub_type st ON st.id = r.sub_type_id
                WHERE r.type_id = '2'
                GROUP BY l.location_name,st.sub_type_name
                ORDER BY total DESC";

        try {
            $rawData3 = \Yii::$app->db->createCommand($sql3)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider3 = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData3,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);



        ///////////////////////// sql แยกแผนกกราฟแท่ง /////////////////
        $sql2 = "SELECT l.location_name,COUNT(r.type_id) AS type_id FROM risk r
                LEFT OUTER JOIN location_riks l ON l.id = r.location_riks_id
                WHERE r.type_id = '2'
                GROUP BY l.location_name";

        $rawData2 = Yii::$app->db->createCommand($sql2)->queryAll();
        $main_data = [];
        foreach ($rawData2 as $data) {
            $main_data[] = [
                'name' => $data['location_name'],
                'y' => $data['type_id'] * 1,
                    //'drilldown' => $data['location_riks_id']
            ];
        }
        $main = json_encode($main_data);

        return $this->render('types2', [
                    // sql ระดับความรุนแรง
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    // sql การทบทวน
                    'dataProvider1' => $dataProvider1,
                    'rawData1' => $rawData1,
                    'sql1' => $sql1,
                    // sql หน่วยงาน+ประเภทย่อย
                    'dataProvider3' => $dataProvider3,
                    'rawData3' => $rawData3,
                    'sql3' => $sql3,
                    // sql แยกแผนกกราฟแท่ง
                    'sql2' => $sql2,
                    'rawData2' => $rawData2,
                    'main' => $main,
        ]);
    }

    public function actionTypes3() {

        ////////////////////// sql ระดับความรุนแรง ///////////////////////
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
                WHERE type_id = '3'
                GROUP BY r.location_riks_id
                UNION ALL
                SELECT 'รวม' AS location,
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
                WHERE type_id = '3'";

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

        ///////////////////////// sql การทบทวน ////////////////////////
        $sql1 = "SELECT s.status_name,COUNT(r.status_id) AS status_id FROM risk r
                LEFT OUTER JOIN status s ON s.id = r.status_id
                WHERE r.type_id = '3'
                GROUP BY s.status_name";

        try {
            $rawData1 = \Yii::$app->db->createCommand($sql1)->queryAll();
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

        ///////////////////////// sql แยกหน่วยงาน+ประเภทย่อย /////////////////
        $sql3 = "SELECT l.location_name,t.type_name,st.sub_type_name,COUNT(st.sub_type_name) AS total FROM risk r
                LEFT OUTER JOIN location_riks l ON l.id = r.location_riks_id
                LEFT OUTER JOIN type t ON t.id = r.type_id
                LEFT OUTER JOIN sub_type st ON st.id = r.sub_type_id
                WHERE r.type_id = '3'
                GROUP BY l.location_name,st.sub_type_name
                ORDER BY total DESC";

        try {
            $rawData3 = \Yii::$app->db->createCommand($sql3)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider3 = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData3,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);



        ///////////////////////// sql แยกแผนกกราฟแท่ง /////////////////
        $sql2 = "SELECT l.location_name,COUNT(r.type_id) AS type_id FROM risk r
                LEFT OUTER JOIN location_riks l ON l.id = r.location_riks_id
                WHERE r.type_id = '3'
                GROUP BY l.location_name";

        $rawData2 = Yii::$app->db->createCommand($sql2)->queryAll();
        $main_data = [];
        foreach ($rawData2 as $data) {
            $main_data[] = [
                'name' => $data['location_name'],
                'y' => $data['type_id'] * 1,
                    //'drilldown' => $data['location_riks_id']
            ];
        }
        $main = json_encode($main_data);

        return $this->render('types3', [
                    // sql ระดับความรุนแรง
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    // sql การทบทวน
                    'dataProvider1' => $dataProvider1,
                    'rawData1' => $rawData1,
                    'sql1' => $sql1,
                    // sql หน่วยงาน+ประเภทย่อย
                    'dataProvider3' => $dataProvider3,
                    'rawData3' => $rawData3,
                    'sql3' => $sql3,
                    // sql แยกแผนกกราฟแท่ง
                    'sql2' => $sql2,
                    'rawData2' => $rawData2,
                    'main' => $main,
        ]);
    }

    public function actionTypes4() {

////////////////////// sql ระดับความรุนแรง ///////////////////////
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
                WHERE type_id = '4'
                GROUP BY r.location_riks_id
                UNION ALL
                SELECT 'รวม' AS location,
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
                WHERE type_id = '4'";

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

        ///////////////////////// sql การทบทวน ////////////////////////
        $sql1 = "SELECT s.status_name,COUNT(r.status_id) AS status_id FROM risk r
                LEFT OUTER JOIN status s ON s.id = r.status_id
                WHERE r.type_id = '4'
                GROUP BY s.status_name";

        try {
            $rawData1 = \Yii::$app->db->createCommand($sql1)->queryAll();
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

        ///////////////////////// sql แยกหน่วยงาน+ประเภทย่อย /////////////////
        $sql3 = "SELECT l.location_name,t.type_name,st.sub_type_name,COUNT(st.sub_type_name) AS total FROM risk r
                LEFT OUTER JOIN location_riks l ON l.id = r.location_riks_id
                LEFT OUTER JOIN type t ON t.id = r.type_id
                LEFT OUTER JOIN sub_type st ON st.id = r.sub_type_id
                WHERE r.type_id = '4'
                GROUP BY l.location_name,st.sub_type_name
                ORDER BY total DESC";

        try {
            $rawData3 = \Yii::$app->db->createCommand($sql3)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider3 = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData3,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);



        ///////////////////////// sql แยกแผนกกราฟแท่ง /////////////////
        $sql2 = "SELECT l.location_name,COUNT(r.type_id) AS type_id FROM risk r
                LEFT OUTER JOIN location_riks l ON l.id = r.location_riks_id
                WHERE r.type_id = '4'
                GROUP BY l.location_name";

        $rawData2 = Yii::$app->db->createCommand($sql2)->queryAll();
        $main_data = [];
        foreach ($rawData2 as $data) {
            $main_data[] = [
                'name' => $data['location_name'],
                'y' => $data['type_id'] * 1,
                    //'drilldown' => $data['location_riks_id']
            ];
        }
        $main = json_encode($main_data);

        return $this->render('types4', [
                    // sql ระดับความรุนแรง
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    // sql การทบทวน
                    'dataProvider1' => $dataProvider1,
                    'rawData1' => $rawData1,
                    'sql1' => $sql1,
                    // sql หน่วยงาน+ประเภทย่อย
                    'dataProvider3' => $dataProvider3,
                    'rawData3' => $rawData3,
                    'sql3' => $sql3,
                    // sql แยกแผนกกราฟแท่ง
                    'sql2' => $sql2,
                    'rawData2' => $rawData2,
                    'main' => $main,
        ]);
    }

    public function actionTypes5() {

////////////////////// sql ระดับความรุนแรง ///////////////////////
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
                WHERE type_id = '5'
                GROUP BY r.location_riks_id
                UNION ALL
                SELECT 'รวม' AS location,
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
                WHERE type_id = '5'";

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

        ///////////////////////// sql การทบทวน ////////////////////////
        $sql1 = "SELECT s.status_name,COUNT(r.status_id) AS status_id FROM risk r
                LEFT OUTER JOIN status s ON s.id = r.status_id
                WHERE r.type_id = '5'
                GROUP BY s.status_name";

        try {
            $rawData1 = \Yii::$app->db->createCommand($sql1)->queryAll();
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

        ///////////////////////// sql แยกหน่วยงาน+ประเภทย่อย /////////////////
        $sql3 = "SELECT l.location_name,t.type_name,st.sub_type_name,COUNT(st.sub_type_name) AS total FROM risk r
                LEFT OUTER JOIN location_riks l ON l.id = r.location_riks_id
                LEFT OUTER JOIN type t ON t.id = r.type_id
                LEFT OUTER JOIN sub_type st ON st.id = r.sub_type_id
                WHERE r.type_id = '5'
                GROUP BY l.location_name,st.sub_type_name
                ORDER BY total DESC";

        try {
            $rawData3 = \Yii::$app->db->createCommand($sql3)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider3 = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData3,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);



        ///////////////////////// sql แยกแผนกกราฟแท่ง /////////////////
        $sql2 = "SELECT l.location_name,COUNT(r.type_id) AS type_id FROM risk r
                LEFT OUTER JOIN location_riks l ON l.id = r.location_riks_id
                WHERE r.type_id = '5'
                GROUP BY l.location_name";

        $rawData2 = Yii::$app->db->createCommand($sql2)->queryAll();
        $main_data = [];
        foreach ($rawData2 as $data) {
            $main_data[] = [
                'name' => $data['location_name'],
                'y' => $data['type_id'] * 1,
                    //'drilldown' => $data['location_riks_id']
            ];
        }
        $main = json_encode($main_data);

        return $this->render('types5', [
                    // sql ระดับความรุนแรง
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    // sql การทบทวน
                    'dataProvider1' => $dataProvider1,
                    'rawData1' => $rawData1,
                    'sql1' => $sql1,
                    // sql หน่วยงาน+ประเภทย่อย
                    'dataProvider3' => $dataProvider3,
                    'rawData3' => $rawData3,
                    'sql3' => $sql3,
                    // sql แยกแผนกกราฟแท่ง
                    'sql2' => $sql2,
                    'rawData2' => $rawData2,
                    'main' => $main,
        ]);
    }

    public function actionTypes6() {

////////////////////// sql ระดับความรุนแรง ///////////////////////
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
                WHERE type_id = '6'
                GROUP BY r.location_riks_id
                UNION ALL
                SELECT 'รวม' AS location,
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
                WHERE type_id = '6'";

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

        ///////////////////////// sql การทบทวน ////////////////////////
        $sql1 = "SELECT s.status_name,COUNT(r.status_id) AS status_id FROM risk r
                LEFT OUTER JOIN status s ON s.id = r.status_id
                WHERE r.type_id = '6'
                GROUP BY s.status_name";

        try {
            $rawData1 = \Yii::$app->db->createCommand($sql1)->queryAll();
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

        ///////////////////////// sql แยกหน่วยงาน+ประเภทย่อย /////////////////
        $sql3 = "SELECT l.location_name,t.type_name,st.sub_type_name,COUNT(st.sub_type_name) AS total FROM risk r
                LEFT OUTER JOIN location_riks l ON l.id = r.location_riks_id
                LEFT OUTER JOIN type t ON t.id = r.type_id
                LEFT OUTER JOIN sub_type st ON st.id = r.sub_type_id
                WHERE r.type_id = '6'
                GROUP BY l.location_name,st.sub_type_name
                ORDER BY total DESC";

        try {
            $rawData3 = \Yii::$app->db->createCommand($sql3)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider3 = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData3,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);



        ///////////////////////// sql แยกแผนกกราฟแท่ง /////////////////
        $sql2 = "SELECT l.location_name,COUNT(r.type_id) AS type_id FROM risk r
                LEFT OUTER JOIN location_riks l ON l.id = r.location_riks_id
                WHERE r.type_id = '6'
                GROUP BY l.location_name";

        $rawData2 = Yii::$app->db->createCommand($sql2)->queryAll();
        $main_data = [];
        foreach ($rawData2 as $data) {
            $main_data[] = [
                'name' => $data['location_name'],
                'y' => $data['type_id'] * 1,
                    //'drilldown' => $data['location_riks_id']
            ];
        }
        $main = json_encode($main_data);

        return $this->render('types6', [
                    // sql ระดับความรุนแรง
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    // sql การทบทวน
                    'dataProvider1' => $dataProvider1,
                    'rawData1' => $rawData1,
                    'sql1' => $sql1,
                    // sql หน่วยงาน+ประเภทย่อย
                    'dataProvider3' => $dataProvider3,
                    'rawData3' => $rawData3,
                    'sql3' => $sql3,
                    // sql แยกแผนกกราฟแท่ง
                    'sql2' => $sql2,
                    'rawData2' => $rawData2,
                    'main' => $main,
        ]);
    }

    public function actionTypes7() {

////////////////////// sql ระดับความรุนแรง ///////////////////////
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
                WHERE type_id = '7'
                GROUP BY r.location_riks_id
                UNION ALL
                SELECT 'รวม' AS location,
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
                WHERE type_id = '7'";

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

        ///////////////////////// sql การทบทวน ////////////////////////
        $sql1 = "SELECT s.status_name,COUNT(r.status_id) AS status_id FROM risk r
                LEFT OUTER JOIN status s ON s.id = r.status_id
                WHERE r.type_id = '7'
                GROUP BY s.status_name";

        try {
            $rawData1 = \Yii::$app->db->createCommand($sql1)->queryAll();
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

        ///////////////////////// sql แยกหน่วยงาน+ประเภทย่อย /////////////////
        $sql3 = "SELECT l.location_name,t.type_name,st.sub_type_name,COUNT(st.sub_type_name) AS total FROM risk r
                LEFT OUTER JOIN location_riks l ON l.id = r.location_riks_id
                LEFT OUTER JOIN type t ON t.id = r.type_id
                LEFT OUTER JOIN sub_type st ON st.id = r.sub_type_id
                WHERE r.type_id = '7'
                GROUP BY l.location_name,st.sub_type_name
                ORDER BY total DESC";

        try {
            $rawData3 = \Yii::$app->db->createCommand($sql3)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider3 = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData3,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);



        ///////////////////////// sql แยกแผนกกราฟแท่ง /////////////////
        $sql2 = "SELECT l.location_name,COUNT(r.type_id) AS type_id FROM risk r
                LEFT OUTER JOIN location_riks l ON l.id = r.location_riks_id
                WHERE r.type_id = '7'
                GROUP BY l.location_name";

        $rawData2 = Yii::$app->db->createCommand($sql2)->queryAll();
        $main_data = [];
        foreach ($rawData2 as $data) {
            $main_data[] = [
                'name' => $data['location_name'],
                'y' => $data['type_id'] * 1,
                    //'drilldown' => $data['location_riks_id']
            ];
        }
        $main = json_encode($main_data);

        return $this->render('types7', [
                    // sql ระดับความรุนแรง
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    // sql การทบทวน
                    'dataProvider1' => $dataProvider1,
                    'rawData1' => $rawData1,
                    'sql1' => $sql1,
                    // sql หน่วยงาน+ประเภทย่อย
                    'dataProvider3' => $dataProvider3,
                    'rawData3' => $rawData3,
                    'sql3' => $sql3,
                    // sql แยกแผนกกราฟแท่ง
                    'sql2' => $sql2,
                    'rawData2' => $rawData2,
                    'main' => $main,
        ]);
    }

    public function actionTypes8() {

////////////////////// sql ระดับความรุนแรง ///////////////////////
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
                WHERE type_id = '8'
                GROUP BY r.location_riks_id
                UNION ALL
                SELECT 'รวม' AS location,
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
                WHERE type_id = '8'";

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

        ///////////////////////// sql การทบทวน ////////////////////////
        $sql1 = "SELECT s.status_name,COUNT(r.status_id) AS status_id FROM risk r
                LEFT OUTER JOIN status s ON s.id = r.status_id
                WHERE r.type_id = '8'
                GROUP BY s.status_name";

        try {
            $rawData1 = \Yii::$app->db->createCommand($sql1)->queryAll();
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

        ///////////////////////// sql แยกหน่วยงาน+ประเภทย่อย /////////////////
        $sql3 = "SELECT l.location_name,t.type_name,st.sub_type_name,COUNT(st.sub_type_name) AS total FROM risk r
                LEFT OUTER JOIN location_riks l ON l.id = r.location_riks_id
                LEFT OUTER JOIN type t ON t.id = r.type_id
                LEFT OUTER JOIN sub_type st ON st.id = r.sub_type_id
                WHERE r.type_id = '8'
                GROUP BY l.location_name,st.sub_type_name
                ORDER BY total DESC";

        try {
            $rawData3 = \Yii::$app->db->createCommand($sql3)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider3 = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData3,
            'pagination' => FALSE,
                /* 'pagination' => [
                  'pageSize' => 10,
                  ], */
        ]);



        ///////////////////////// sql แยกแผนกกราฟแท่ง /////////////////
        $sql2 = "SELECT l.location_name,COUNT(r.type_id) AS type_id FROM risk r
                LEFT OUTER JOIN location_riks l ON l.id = r.location_riks_id
                WHERE r.type_id = '8'
                GROUP BY l.location_name";

        $rawData2 = Yii::$app->db->createCommand($sql2)->queryAll();
        $main_data = [];
        foreach ($rawData2 as $data) {
            $main_data[] = [
                'name' => $data['location_name'],
                'y' => $data['type_id'] * 1,
                    //'drilldown' => $data['location_riks_id']
            ];
        }
        $main = json_encode($main_data);

        return $this->render('types8', [
                    // sql ระดับความรุนแรง
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
                    // sql การทบทวน
                    'dataProvider1' => $dataProvider1,
                    'rawData1' => $rawData1,
                    'sql1' => $sql1,
                    // sql หน่วยงาน+ประเภทย่อย
                    'dataProvider3' => $dataProvider3,
                    'rawData3' => $rawData3,
                    'sql3' => $sql3,
                    // sql แยกแผนกกราฟแท่ง
                    'sql2' => $sql2,
                    'rawData2' => $rawData2,
                    'main' => $main,
        ]);
    }

}
