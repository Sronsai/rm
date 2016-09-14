<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LocationReportRSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Location Reports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-report-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Location Report', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'location_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
