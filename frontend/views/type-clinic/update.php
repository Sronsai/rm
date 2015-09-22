<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TypeClinic */

$this->title = 'Update Type Clinic: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Type Clinics', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="type-clinic-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
