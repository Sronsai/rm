<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SafeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Saves';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="safe-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Safe', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'safe_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
