<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
//use yii\bootstrap\ActiveForm;
use frontend\models\Type;
use frontend\models\SubType;
use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $model frontend\models\Risk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="risk-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--?= $form->field($model, 'person_id')->textInput() ?-->
    <?=
    $form->field($model, 'person_id')->dropDownList(
            ArrayHelper::map(\frontend\models\Person::find()->all(), 'id', 'person_type'), ['prompt' => '<== เหตุการณ์เกิดกับ ==>'])
    ?>

    <?= $form->field($model, 'hn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pname')->dropDownList([ 'นาย' => 'นาย', 'นาง' => 'นาง', 'น.ส.' => 'น.ส.',], ['prompt' => '<== คำนำหน้า ==>']) ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'location_riks_id')->textInput() ?-->
    <?=
    $form->field($model, 'location_riks_id')->dropDownList(
            ArrayHelper::map(\frontend\models\LocationRiks::find()->all(), 'id', 'location_name'), ['prompt' => '<== เหตุการณ์เกิดกับ ==>'])
    ?>

    <!--?= $form->field($model, 'location_report_id')->textInput() ?-->
    <?=
    $form->field($model, 'location_report_id')->dropDownList(
            ArrayHelper::map(\frontend\models\LocationReport::find()->all(), 'id', 'location_name'), ['prompt' => '<== หน่วยงานที่รายงาน ==>'])
    ?>

    <!--?= $form->field($model, 'location_connection_id')->textInput() ?-->
    <?=
    $form->field($model, 'location_connection_id')->dropDownList(
            ArrayHelper::map(\frontend\models\LocationConnection::find()->all(), 'id', 'location_name'), ['prompt' => '<== หน่วยงานที่เกี่ยวข้อง ==>'])
    ?>
    <br>

    <div class="form-inline">
        <?=
        $form->field($model, 'risk_date')->widget(yii\jui\DatePicker::className(), [
            'name' => 'risk_date',
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => [
                'placeholder' => '                    <== วันที่เกิดเหตุ ==>',
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

        <!--?= $form->field($model, 'risk_report')->textInput() ?-->
        <?=
        $form->field($model, 'risk_report')->widget(yii\jui\DatePicker::className(), [
            'name' => 'risk_report',
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => [
                'placeholder' => '                    <== วันที่รายงาน ==>',
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
    <br>

    <?= $form->field($model, 'risk_summary')->textarea(['rows' => 6]) ?>










    <!--?= $form->field($model, 'type_id')->textInput() ?-->
    <!--?=
    $form->field($model, 'type_id')->dropDownList(
            ArrayHelper::map(\frontend\models\Type::find()->all(), 'id', 'type_name'), ['prompt' => '<== ประเภทความเสี่ยง ==>'])
    ?-->
    <?=
    $form->field($model, 'type_id')->dropDownList(
            ArrayHelper::map(\frontend\models\Type::find()->all(), 'id', 'type_name'), [
        'prompt' => '<== ประเภทความเสี่ยง ==>',
        'onchange' => ' 
                    $.post("index.php?r=subtype/lists&id=' . '"+$(this).val(), function(data) {
                        $("select#models-contact").html( data );                        
                    });'
    ]);
    ?>


    <?=
    $form->field($model, 'id')->dropDownList(
            ArrayHelper::map(\frontend\models\SubType::find()->all(), 'id', 'sub_type_name'), [
        'prompt' => '<== ประเภทความเสี่ยงย่อย ==>',
    ]);
    ?>



    <!--?= $form->field($model, 'level_id')->textInput() ?-->
    <?=
    $form->field($model, 'level_id')->dropDownList(
            ArrayHelper::map(\frontend\models\Level::find()->all(), 'id', 'level_name'), ['prompt' => '<== ระดับความรุนแรง ==>'])
    ?>

    <!--?= $form->field($model, 'clear_id')->textInput() ?-->
    <?=
    $form->field($model, 'clear_id')->dropDownList(
            ArrayHelper::map(\frontend\models\Clear::find()->all(), 'id', 'clear_name'), ['prompt' => '<== สาเหตุที่ชัดเจน ==>'])
    ?>

    <!--?= $form->field($model, 'system_id')->textInput() ?-->
    <?=
    $form->field($model, 'system_id')->dropDownList(
            ArrayHelper::map(\frontend\models\System::find()->all(), 'id', 'system_name'), ['prompt' => '<== สาเหตุเชิงระบบ ==>'])
    ?>

    <!--?= $form->field($model, 'status_id')->textInput() ?-->
    <?=
    $form->field($model, 'status_id')->dropDownList(
            ArrayHelper::map(\frontend\models\Status::find()->all(), 'id', 'status_name'), ['prompt' => '<== ติดตาม / ทบทวน ==>'])
    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
