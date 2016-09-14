<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EtcSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Etcs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etc-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Etc', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'etc_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
