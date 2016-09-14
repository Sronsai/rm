<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TypeClinicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Type Clinics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-clinic-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Type Clinic', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'clinic_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
