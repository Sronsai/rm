<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\RiskMed */

$this->title = 'แก้ไขรายการที่: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'บันทึกความเสี่ยง (ยา)', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'เปิดดู', $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="risk-med-update">

    <?= $this->render('_form', [
        'model' => $model,
        'initialPreview'=>$initialPreview,
        'initialPreviewConfig'=>$initialPreviewConfig
    ]) ?>

</div>
