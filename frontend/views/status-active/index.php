<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\StatusActiveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Status Actives';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-active-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Status Active', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'status_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
