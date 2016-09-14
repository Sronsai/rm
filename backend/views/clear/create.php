<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Clear */

$this->title = 'เพิ่มสาเหตุที่ชัดแจ้ง';
$this->params['breadcrumbs'][] = ['label' => 'สาเหตุที่ชัดแจ้ง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="clear-create">
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
