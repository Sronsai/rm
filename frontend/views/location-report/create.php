<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\LocationReport */

$this->title = 'Create Location Report';
$this->params['breadcrumbs'][] = ['label' => 'Location Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
