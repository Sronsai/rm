<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Clear */

$this->title = 'แก้ไขสาเหตุที่ชัดแจ้ง: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'สาเหตุที่ชัดแจ้ง', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="clear-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
