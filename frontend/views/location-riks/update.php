<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\LocationRiks */

$this->title = 'Update Location Riks: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Location Riks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="location-riks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
