<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\LocationRiks */

$this->title = 'Create Location Riks';
$this->params['breadcrumbs'][] = ['label' => 'Location Riks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-riks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
