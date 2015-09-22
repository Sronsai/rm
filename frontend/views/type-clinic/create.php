<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\TypeClinic */

$this->title = 'Create Type Clinic';
$this->params['breadcrumbs'][] = ['label' => 'Type Clinics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-clinic-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
