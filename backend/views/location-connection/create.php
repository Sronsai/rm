<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LocationConnection */

$this->title = 'เพิ่มหน่วยงานเกี่ยวข้อง';
$this->params['breadcrumbs'][] = ['label' => 'หน่วยงานเกี่ยวข้อง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-connection-create">
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
