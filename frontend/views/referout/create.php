<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Referout */

$this->title = 'Create Referout';
$this->params['breadcrumbs'][] = ['label' => 'Referouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="referout-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
