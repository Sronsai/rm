<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LocationConnection */

$this->title = 'แก้ไขหน่วยงานเกี่ยวข้อง: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'หน่วยงานเกี่ยวข้อง', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="location-connection-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
