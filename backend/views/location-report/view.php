<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\LocationReport */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'หน่วยงานที่รายงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-report-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'location_name',
        ],
    ]) ?>

</div>
