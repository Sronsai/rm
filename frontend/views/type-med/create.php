<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\TypeMed */

$this->title = 'Create Type Med';
$this->params['breadcrumbs'][] = ['label' => 'Type Meds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-med-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
