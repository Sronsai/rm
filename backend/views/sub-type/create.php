<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SubType */

$this->title = 'เพิ่มประเภทย่อย';
$this->params['breadcrumbs'][] = ['label' => 'ประเภทย่อย', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-type-create">
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
