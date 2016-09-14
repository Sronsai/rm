<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use frontend\models\TypeMed;
use frontend\models\SubMedType;
use frontend\models\TypeClinic;
use yii\bootstrap\Tabs;
use yii\web\JsExpression;
use kartik\widgets\DateTimePicker;
use kartik\widgets\FileInput;
use kartik\checkbox\CheckboxX;

/* @var $this yii\web\View */
/* @var $model frontend\models\RiskMed */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="risk-med-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="risk-med-form">
        <div class="panel panel-primary">
            <div class="panel-heading"><center><H3><?= Html::img('./../images/med.jpg'); ?>&nbsp;&nbsp;ใบความเสี่ยง (ยา)</H3></center></div>
            <div class="panel-body">
                <div class="row">

                    <?= $form->field($model, 'ref')->hiddenInput()->label(false); ?>

                    <div class="col-md-12 col-sm-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"></div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-2">

                                        <?=
                                        $form->field($model, 'person_id')->dropDownList(
                                                ArrayHelper::map(\frontend\models\Person::find()->all(), 'id', 'person_type'), ['prompt' => ''])
                                        ?>

                                    </div>
                                    <div class="col-xs-2">
                                        <?= $form->field($model, 'hn')->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-xs-2">
                                        <?=
                                        $form->field($model, 'pname')->dropDownList([
                                            'นาย' => 'นาย',
                                            'นาง' => 'นาง',
                                            'น.ส.' => 'น.ส.',
                                            'ด.ช.' => 'ด.ช.',
                                            'ด.ญ.' => 'ด.ญ.',
                                                ], ['prompt' => ''])
                                        ?>
                                    </div>
                                    <div class="col-xs-3">
                                        <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-xs-3">
                                        <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="panel panel-info">
                                        <div class="panel-heading"></div>
                                        <div class="panel-body">
                                            <?=
                                            $form->field($model, 'risk_date')->widget(DateTimePicker::classname(), [
                                                'options' => ['placeholder' => 'บันทึกวันที่ และเวลา...'],
                                                'language' => 'th',
                                                'pluginOptions' => [
                                                    'autoclose' => true,
                                                    'dateFormat' => 'yyyy-MM-dd',
                                                    'class' => 'form-control',
                                                    'changeMonth' => true,
                                                    'changeYear' => true,
                                                    'yearRange' => '1996:2099',
                                                    'showOn' => 'button',
                                                    'buttonImage' => 'images/calendar.gif',
                                                    'buttonImageOnly' => true,
                                                    'buttonText' => 'Select date'
                                                ]
                                            ]);
                                            ?>

                                            <?=
                                            $form->field($model, 'risk_report')->widget(DateTimePicker::classname(), [
                                                'options' => ['placeholder' => 'บันทึกวันที่ และเวลา...'],
                                                'language' => 'th',
                                                'pluginOptions' => [
                                                    'autoclose' => true,
                                                    'dateFormat' => 'yyyy-MM-dd',
                                                    'class' => 'form-control',
                                                    'changeMonth' => true,
                                                    'changeYear' => true,
                                                    'yearRange' => '1996:2099',
                                                    'showOn' => 'button',
                                                    'buttonImage' => 'images/calendar.gif',
                                                    'buttonImageOnly' => true,
                                                    'buttonText' => 'Select date'
                                                ]
                                            ]);
                                            ?>

                                            <?= $form->field($model, 'type_clinic_id')->inline()->radioList($model->getItemTypeClinic())->label('ประเภทคลินิค', ['class' => 'label-class']) ?>

                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="panel panel-info">
                                        <div class="panel-heading"></div>
                                        <div class="panel-body">
                                            <?=
                                            $form->field($model, 'location_riks_id')->dropDownList(
                                                    ArrayHelper::map(\frontend\models\LocationRiks::find()->all(), 'id', 'location_name'), [
                                                'prompt' => '<=======  เลือกหน่วยงานต้นเหตุ  =======>'])
                                            ?>

                                            <?=
                                            $form->field($model, 'location_connection_id')->dropDownList(
                                                    ArrayHelper::map(\frontend\models\LocationConnection::find()->all(), 'id', 'location_name'), [
                                                'prompt' => '<======  เลือกหน่วยงานที่เกี่ยวข้อง  =====>'])
                                            ?>

                                            <?=
                                            $form->field($model, 'location_report_id')->dropDownList(
                                                    ArrayHelper::map(\frontend\models\LocationReport::find()->all(), 'id', 'location_name'), [
                                                'prompt' => '<======  เลือกหน่วยงานที่รายงาน  ======>'])
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="panel panel-info">
                                        <div class="panel-heading"></div>
                                        <div class="panel-body">
                                            <?=
//Dependent DropDownlist
                                            $form->field($model, 'type_med_id')->dropDownList(
                                                    ArrayHelper::map(\frontend\models\TypeMed::find()->all(), 'id', 'type_name'), [
                                                'prompt' => '<======  เลือกประเภทความเสี่ยง  ======>',
                                                'onchange' => '
                                                                                $.post("index.php?r=sub-med-type/lists&id=' . '"+$(this).val(), function(data) {
                                                                                    $("select#riskmed-sub_med_type_id").html( data );
                                                                                });'
                                            ]);             //index.php?r=sub-type/lists&id    sub-med-type คือ Controller
                                            ?> 

                                            <?=
                                            $form->field($model, 'sub_med_type_id')->dropDownList(
                                                    ArrayHelper::map(\frontend\models\SubMedType::find()->all(), 'id', 'sub_med_type_name'), [  //แล้วไปทำใน actionLists   'id', 'sub_med_type_name' ให้ตรง
                                                'prompt' => '<====  เลือกประเภทความเสี่ยงย่อย  ====>',
                                            ]);
                                            ?>

                                            <?=
                                            $form->field($model, 'level_id')->dropDownList(
                                                    ArrayHelper::map(\frontend\models\Level::find()->all(), 'id', 'level_name'), [
                                                'prompt' => '<======  เลือกระดับความรุนแรง  =====>',
                                                    //'style' => 'width:250px;'
                                            ])
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="panel panel-info">
                                        <div class="panel-heading"></div>
                                        <div class="panel-body">
                                            <?= $form->field($model, 'risk_summary')->textarea(['rows' => 4]) ?>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>




                    </div>
                </div>             
            </div>
        </div>
    </div>

    <?php if (Yii::$app->user->identity->role == 20 || Yii::$app->user->identity->role == 30) {
        ?>


        <div class="panel panel-danger">
            <div class="panel-heading"><center><h3>คณะกรรมการบริหารจัดการความเสี่ยง เพื่อเข้าทบทวนความเสี่ยง (ยา)</h3></center></div>
            <div class="panel-body">
                <div class="row">

                    <div class="col-md-4">
                        <?=
                        $form->field($model, 'clear_id')->dropDownList(
                                ArrayHelper::map(\frontend\models\Clear::find()->all(), 'id', 'clear_name'), ['prompt' => ''])
                        ?>
                    </div>
                    <div class="col-md-4">
                        <?=
                        $form->field($model, 'system_id')->dropDownList(
                                ArrayHelper::map(\frontend\models\System::find()->all(), 'id', 'system_name'), ['prompt' => ''])
                        ?>
                    </div>

                    <div class="col-md-4">
                        <div class="panel panel-success">
                            <div class="panel-body">
                                <center>
                                    <!--?=
                                    $form->field($model, 'status_id')->dropDownList(
                                            ArrayHelper::map(\frontend\models\Status::find()->all(), 'id', 'status_name'), ['prompt' => ''])
                                            ?-->

                                    <?=
                                    $form->field($model, 'status_id')->inline()->radioList($model->getItemStatus());
                                    ?>

                                    <i class="fa fa-spinner fa-pulse fa-2x"></i>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <i class="fa fa-thumbs-o-up fa-2x"></i></center>
                            </div>
                        </div>
                    </div>




                    <div class = "col-md-12">
                        <?=
                        $form->field($model, 'risk_review')->textarea(['rows' => 4])
                        ?>
                    </div>

                    <div class = "col-md-12">
                        <?=
                        $form->field($model, 'join_status')->textarea(['rows' => 4])
                        ?>
                    </div>

                    <div class = "col-md-12">
                        <?=
                        $form->field($model, 'docs[]')->widget(FileInput::classname(), [
                            'options' => [
                                //'accept' => 'image/*',
                                'multiple' => true
                            ],
                            'pluginOptions' => [
                                'initialPreview' => $model->initialPreview($model->docs, 'docs', 'file'),
                                'initialPreviewConfig' => $model->initialPreview($model->docs, 'docs', 'config'),
                                'allowedFileExtensions' => ['rar', 'zip', 'pdf', 'doc', 'docx', 'xls', 'xlsx'],
                                'showPreview' => false,
                                //'showPreview' => true,
                                'showCaption' => true,
                                'showRemove' => true,
                                'showUpload' => false
                            ]
                        ]);
                        ?>

                        <div class="form-group field-upload_files">
                            <label class="control-label" for="upload_files[]"> ไฟล์ภาพถ่าย </label>
                            <div>
                                <?=
                                FileInput::widget([
                                    'name' => 'upload_ajax[]',
                                    'options' => ['multiple' => true, 'accept' => 'image/*'], //'accept' => 'image/*' หากต้องเฉพาะ image
                                    'pluginOptions' => [
                                        'overwriteInitial' => false,
                                        'initialPreviewShowDelete' => true,
                                        'initialPreview' => $initialPreview,
                                        'initialPreviewConfig' => $initialPreviewConfig,
                                        'uploadUrl' => Url::to(['/risk-library/upload-ajax']),
                                        'uploadExtraData' => [
                                            'ref' => $model->ref,
                                        ],
                                        'maxFileCount' => 100
                                    ]
                                ]);
                                ?>
                            </div>
                        </div>

                    </div>

                    <?php
                } else {
                    ?>

                <?php } ?>

            </div>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'บันทึก', ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-success') . ' btn-lg btn-block']) ?>
            </div>
        </div>

    </div>

</div>

<?php ActiveForm::end(); ?>

</div>



<!-- Insert From By Ajax -->
<?php
$script = <<< JS

$('form#{$model->formName()}').on('beforeSubmit',function(e)
{
  var \$form = $(this);
    $.post(
        \$form.attr("action"),  //serialze Yii2 form
        \$form.serialize()
    ) 
        .done(function(result){
        if(result.message == 'Success')
        {
            $(document).find('#secondmodal').modal('hide');
            $.pjax.reload({container:'#commodity-grid'});
        }else
        {
            $(\$form).trigger("reset");
            $("#message").html(result.message);
        }
        }).fail(function()
        {
            console.log("server error");
        });
    return false;
});

JS;
$this->registerJs($script);
?>