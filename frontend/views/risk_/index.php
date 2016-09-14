<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RiskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Risks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risk-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Risk', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'status_id',
                'value' => 'status.status_name',
            ],
            //'id',
            //'person_id',
            //'hn',
            //'pname',
            //'fname',
            // 'lname',
            //'location_riks_id',
            [
                'attribute' => 'location_riks_id',
                'value' => 'locationRiks.location_name',
            ],
            // 'location_report_id',
            [
                'attribute' => 'location_connection_id',
                'value' => 'locationConnection.location_name',
            ],
            'risk_date',
            'risk_report',
            'risk_summary:ntext',
            // 'type_id',
            // 'level_id',
            // 'clear_id',
            // 'system_id',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
