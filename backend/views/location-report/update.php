<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LocationReport */

$this->title = 'แก้ไขหน่วยงานที่รายงานที่ : ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'หน่วยงานที่รายงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="location-report-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
