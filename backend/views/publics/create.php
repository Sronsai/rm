<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Publics */

$this->title = 'Create Publics';
$this->params['breadcrumbs'][] = ['label' => 'Publics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publics-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
