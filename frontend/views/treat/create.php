<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Treat */

$this->title = 'Create Treat';
$this->params['breadcrumbs'][] = ['label' => 'Treats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="treat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
