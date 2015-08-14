<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\RiskSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="risk-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <div class="form-group">
        <div id="global1">
            <?= $form->field($model, 'globalSearch') ?>  
        </div>
        </br>
        <div id="global2">
            <!--?= Html::submitButton('<i class="fa fa-search"></i>', ['class' => 'btn btn-success']) ?-->
            <?= Html::submitButton('ค้นหาแบบละเอียด', ['class' => 'btn btn-success']) ?>
            <!--?= Html::resetButton('คืนค่า', ['class' => 'btn btn-default']) ?-->
        </div>
    </div>



    <?php ActiveForm::end(); ?>

</div>


