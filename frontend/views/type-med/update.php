<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TypeMed */

$this->title = 'Update Type Med: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Type Meds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="type-med-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
