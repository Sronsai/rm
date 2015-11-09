<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Referout */

$this->title = 'ทำการทบทวนเลขที่ : ' . ' ' . $model->refer_no;
$this->params['breadcrumbs'][] = ['label' => 'Referouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->refer_no, 'url' => ['view', 'id' => $model->refer_no]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="referout-update">

    <center><h1><u><?= Html::encode($this->title) ?></u></h1></center>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

