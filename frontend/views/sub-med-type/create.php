<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\SubMedType */

$this->title = 'Create Sub Med Type';
$this->params['breadcrumbs'][] = ['label' => 'Sub Med Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-med-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
