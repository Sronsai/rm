<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\System */

$this->title = 'แก้ไขสาเหตุเชิงระบบ: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'สาเหตุเชิงระบบ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="system-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
