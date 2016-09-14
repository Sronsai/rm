<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\SubType */

$this->title = 'Create Sub Type';
$this->params['breadcrumbs'][] = ['label' => 'Sub Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
