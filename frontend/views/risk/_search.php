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

    <!--?=
    $form->field($model, 'globalSearch')->textInput(['style' => 'color:red']);
    ?-->

    <!--?=
    $form->field($model, 'globalSearch', [
        'template' => "{input}\n{error}",
        'inputOptions' => [
            'placeholder' => 'ค้นหาแบบระเอียด',
            'class' => 'form-control'
        ]
            ]
    )->textInput(['style' => 'color:red']);
    ?-->

    <!--div class="form-group">
    <!--?= Html::submitButton('Search',['class' => 'btn btn-primary']) ?>
    <!--?= Html::resetButton('Reset',['class' => 'btn btn-default']) ?>
</div-->

    <?php ActiveForm::end(); ?>

</div>


