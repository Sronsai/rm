<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PublicsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Publics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publics-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Publics', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'public_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
