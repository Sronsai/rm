<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Level */

$this->title = 'แก้ไขระดับความรุนแรง: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'ระดับความรุนแรง', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="level-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
