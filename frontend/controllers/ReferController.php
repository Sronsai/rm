<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;


class ReferController extends Controller {

    public function actionIndex() {


        $sql = "SELECT ca.cause_referout_name,count(re.cause_referout_id) as total FROM referout re
                LEFT OUTER JOIN cause_referout ca ON ca.cause_referout_id = re.cause_referout_id
                GROUP BY ca.cause_referout_name
                ORDER BY total DESC";

        $rawData = Yii::$app->db_refer->createCommand($sql)->queryAll();
        $main_data = [];
        foreach ($rawData as $data) {
            $main_data[] = [
                'name' => $data['cause_referout_name'],
                'y' => $data['total'] * 1,
                    //'drilldown' => $data['location_riks_id']
            ];
        }
        $main = json_encode($main_data);

        return $this->render('index', [
                    'sql' => $sql,
                    'main' => $main,
        ]);
    }

}
