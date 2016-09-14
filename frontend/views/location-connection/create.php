<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\LocationConnection */

$this->title = 'Create Location Connection';
$this->params['breadcrumbs'][] = ['label' => 'Location Connections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-connection-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
