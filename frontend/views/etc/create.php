<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Etc */

$this->title = 'Create Etc';
$this->params['breadcrumbs'][] = ['label' => 'Etcs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
