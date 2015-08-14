<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Safe */

$this->title = 'Create Safe';
$this->params['breadcrumbs'][] = ['label' => 'Saves', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="safe-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
