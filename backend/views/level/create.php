<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Level */

$this->title = 'เพิ่มระดับความรุนแรง';
$this->params['breadcrumbs'][] = ['label' => 'ระดับความรุนแรง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="level-create">
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