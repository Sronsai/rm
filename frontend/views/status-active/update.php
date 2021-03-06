<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\StatusActive */

$this->title = 'Update Status Active: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Status Actives', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="status-active-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
