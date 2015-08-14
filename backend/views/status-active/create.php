<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\StatusActive */

$this->title = 'Create Status Active';
$this->params['breadcrumbs'][] = ['label' => 'Status Actives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-active-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
