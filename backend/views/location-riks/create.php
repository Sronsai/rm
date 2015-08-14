<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LocationRiks */

$this->title = 'เพิ่มสถานที่เกิดเหตุ';
$this->params['breadcrumbs'][] = ['label' => 'สถานที่เกิดเหตุ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-riks-create">
    <div class="panel panel-success">
        <div class="panel-heading"><center><H1><?= Html::encode($this->title) ?></H1></center></div>
        <div class="panel-body">

            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>

        </div>
    </div>
</div>
