<?php

namespace frontend\controllers;

use yii;

class DepartmentController extends \yii\web\Controller {

    public $enableCsrfValidation = false;

    public function actionDoctor() {
        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '1' ";

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

        return $this->render('doctor', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionEr() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '2' ";

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

        return $this->render('er', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionPhar() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '3' ";

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

        return $this->render('phar', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionLab() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '4' ";

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

        return $this->render('lab', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionXray() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '5' ";

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

        return $this->render('xray', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionDent() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '6' ";

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

        return $this->render('dent', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionOpd() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '7' ";

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

        return $this->render('opd', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionIpd() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '8' ";

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

        return $this->render('ipd', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionVech() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '9' ";

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

        return $this->render('vech', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionLr() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '10' ";

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

        return $this->render('lr', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionCard() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '11' ";

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

        return $this->render('card', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionMon() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '12' ";

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

        return $this->render('mon', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionCar() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '13' ";

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

        return $this->render('car', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionRepair() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '14' ";

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

        return $this->render('repair', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionIt() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '15' ";

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

        return $this->render('it', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionLaunder() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '16' ";

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

        return $this->render('launder', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionCenter() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '17' ";

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

        return $this->render('center', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionDiet() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '18' ";

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

        return $this->render('diet', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionClaim() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '19' ";

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

        return $this->render('claim', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionCounsel() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '20' ";

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

        return $this->render('counsel', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionSecurity() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '21' ";

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

        return $this->render('security', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionPhysical() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '22' ";

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

        return $this->render('physical', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionNcd() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '23' ";

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

        return $this->render('ncd', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionTb() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '24' ";

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

        return $this->render('tb', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionIcc() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '25' ";

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

        return $this->render('icc', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionPct() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '26' ";

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

        return $this->render('pct', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionPtc() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '27' ";

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

        return $this->render('ptc', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionHph() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '28' ";

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

        return $this->render('hph', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionRm() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '29' ";

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

        return $this->render('rm', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionEnv() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '30' ";

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

        return $this->render('env', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionEqm() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '31' ";

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

        return $this->render('eqm', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionMrs() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '32' ";

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

        return $this->render('mrs', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionMis() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '33' ";

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

        return $this->render('mis', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionHrd() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '34' ";

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

        return $this->render('hrd', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionOr() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '35' ";

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

        return $this->render('or', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionMa() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '36' ";

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

        return $this->render('ma', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

    public function actionStock() {

        $sql = " select r.hn,concat(r.pname,r.fname,'  ',r.lname) as fullname
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
WHERE lr.id = '37' ";

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

        return $this->render('stock', [
                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'sql' => $sql,
        ]);
    }

}
