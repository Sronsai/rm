<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\components\AccessRule;
use common\models\User;


class IndicationsController extends Controller {

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
		'only' => ['index', 'create', 'update', 'view', 'delete'],
		'ruleConfig' => [
		'class' => AccessRule::className()
		],
		'rules' => [
		[
		'actions' => ['index', 'create', 'view'],
		'allow' => true,
		'roles' => [
		User::ROLE_USER,
		User::ROLE_MODERATOR,
		User::ROLE_ADMIN
		]
		],
		[
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
		]
		]
		]
		];
	}

	public function actionIndex() {

		$sql = ' SELECT s.status_name as status, 
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=10 and r.status_id=s.id )as "oct",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=11 and r.status_id=s.id )as "nov",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=12 and r.status_id=s.id )as "dece",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=1 and r.status_id=s.id )as "jan",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=2 and r.status_id=s.id )as "feb",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=3 and r.status_id=s.id )as "mar",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=4 and r.status_id=s.id )as "apr",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=5 and r.status_id=s.id )as "may",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=6 and r.status_id=s.id )as "june",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=7 and r.status_id=s.id )as "july",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=8 and r.status_id=s.id )as "aug",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2559" and month(r.risk_date)=9 and r.status_id=s.id )as "sep"

		FROM status s
		';

		try {
			$rawData = \Yii::$app->db->createCommand($sql)->queryAll();
		} catch (\yii\db\Exception $e) {
			throw new \yii\web\ConflictHttpException('sql error');
		}
		$dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
			'allModels' => $rawData,
			'pagination' => FALSE,
			]);

		$title = "ตัวชี้วัด ภาพรวมอัตราความเสี่ยงที่ได้รับการจัดการ ปีงบ 2559";
		$type11 = Yii::$app->db->createCommand("SELECT count(r.status_id) as total from risk r where r.status_id ='1' and r.risk_date between '2015-10-01' and '2016-09-30' ")->queryScalar();
		$type12 = Yii::$app->db->createCommand("SELECT count(r.status_id) as total from risk r where r.status_id ='2' and r.risk_date between '2015-10-01' and '2016-09-30' ")->queryScalar();

		return $this->render('index',[
			'dataProvider' => $dataProvider,
			'title' => $title,
			'type11' => $type11,
			'type12' => $type12,
			]);
	}

	public function actionIndex2558() {

		$sql = ' SELECT s.status_name as status, 
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=10 and r.status_id=s.id )as "oct",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=11 and r.status_id=s.id )as "nov",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=12 and r.status_id=s.id )as "dece",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=1 and r.status_id=s.id )as "jan",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=2 and r.status_id=s.id )as "feb",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=3 and r.status_id=s.id )as "mar",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=4 and r.status_id=s.id )as "apr",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=5 and r.status_id=s.id )as "may",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=6 and r.status_id=s.id )as "june",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=7 and r.status_id=s.id )as "july",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=8 and r.status_id=s.id )as "aug",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2558" and month(r.risk_date)=9 and r.status_id=s.id )as "sep"

		FROM status s
		';

		try {
			$rawData = \Yii::$app->db->createCommand($sql)->queryAll();
		} catch (\yii\db\Exception $e) {
			throw new \yii\web\ConflictHttpException('sql error');
		}
		$dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
			'allModels' => $rawData,
			'pagination' => FALSE,
			]);

		$title = "ตัวชี้วัด ภาพรวมอัตราความเสี่ยงที่ได้รับการจัดการ ปีงบ 2558";
		$type11 = Yii::$app->db->createCommand("SELECT count(r.status_id) as total from risk r where r.status_id ='1' and r.risk_date between '2014-10-01' and '2015-09-30' ")->queryScalar();
		$type12 = Yii::$app->db->createCommand("SELECT count(r.status_id) as total from risk r where r.status_id ='2' and r.risk_date between '2014-10-01' and '2015-09-30' ")->queryScalar();

		return $this->render('index2558',[
			'dataProvider' => $dataProvider,
			'title' => $title,
			'type11' => $type11,
			'type12' => $type12,
			]);
	}

	public function actionIndex2560() {

		$sql = ' SELECT s.status_name as status, 
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=10 and r.status_id=s.id )as "oct",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=11 and r.status_id=s.id )as "nov",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=12 and r.status_id=s.id )as "dece",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=1 and r.status_id=s.id )as "jan",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=2 and r.status_id=s.id )as "feb",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=3 and r.status_id=s.id )as "mar",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=4 and r.status_id=s.id )as "apr",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=5 and r.status_id=s.id )as "may",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON    (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=6 and r.status_id=s.id )as "june",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=7 and r.status_id=s.id )as "july",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=8 and r.status_id=s.id )as "aug",
		(SELECT COUNT(status_id) as cc FROM risk r
		LEFT OUTER JOIN stock_bdg_year s ON (r.risk_date >= s.begin_date and r.risk_date <= s.end_date)
		where s.bdg_year="2560" and month(r.risk_date)=9 and r.status_id=s.id )as "sep"

		FROM status s
		';

		try {
			$rawData = \Yii::$app->db->createCommand($sql)->queryAll();
		} catch (\yii\db\Exception $e) {
			throw new \yii\web\ConflictHttpException('sql error');
		}
		$dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
			'allModels' => $rawData,
			'pagination' => FALSE,
			]);

		$title = "ตัวชี้วัด ภาพรวมอัตราความเสี่ยงที่ได้รับการจัดการ ปีงบ 2560";
		$type11 = Yii::$app->db->createCommand("SELECT count(r.status_id) as total from risk r where r.status_id ='1' and r.risk_date between '2016-10-01' and '2017-09-30' ")->queryScalar();
		$type12 = Yii::$app->db->createCommand("SELECT count(r.status_id) as total from risk r where r.status_id ='2' and r.risk_date between '2016-10-01' and '2017-09-30' ")->queryScalar();

		return $this->render('index2560',[
			'dataProvider' => $dataProvider,
			'title' => $title,
			'type11' => $type11,
			'type12' => $type12,
			]);
	}

}

?>