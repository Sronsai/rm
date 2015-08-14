<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StatusDescription */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="status-description-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropDownList([ 'ต้องทบทวน' => 'ต้องทบทวน', 'ติดตาม' => 'ติดตาม', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'status_date')->textInput() ?>

    <?= $form->field($model, 'status_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_active_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
