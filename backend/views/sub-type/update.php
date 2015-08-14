<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SubType */

$this->title = 'แก้ไขเพิ่มประเภทย่อย: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'เพิ่มประเภทย่อย', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="sub-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
