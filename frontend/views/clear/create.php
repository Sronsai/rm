<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Clear */

$this->title = 'Create Clear';
$this->params['breadcrumbs'][] = ['label' => 'Clears', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clear-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
