<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\StatusDescription */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="status-description-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-inline">
        <?=
        $form->field($model, 'status_date')->widget(yii\jui\DatePicker::className(), [
            'name' => 'status_date',
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => [
                'placeholder' => '                    <== วันที่ทบทวน ==>',
                'style' => 'width:250px;',
                'class' => 'form-control',
                'changeMonth' => true,
                'changeYear' => true,
                'yearRange' => '1996:2099',
                'showOn' => 'button',
                'buttonImage' => 'images/calendar.gif',
                'buttonImageOnly' => true,
                'buttonText' => 'Select date'
            ],
        ])
        ?>
    </div>

    <?= $form->field($model, 'status_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status_name')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'status_active_id')->textInput() ?-->
    <?=
    $form->field($model, 'status_active_id')->dropDownList(
            ArrayHelper::map(\frontend\models\StatusActive::find()->all(), 'id', 'status_name'), ['prompt' => '<== สถานะการทบทวน ==>'])
    ?>

    <!--?= $form->field($model, 'status_id')->textInput() ?-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
