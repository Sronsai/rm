<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\SubType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'type_id')->dropDownList(
            ArrayHelper::map(\frontend\models\Type::find()->all(), 'id', 'type_name'), ['prompt' => '<== ประเภทความเสี่ยง ==>'])
    ?>

    <?= $form->field($model, 'sub_type_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
