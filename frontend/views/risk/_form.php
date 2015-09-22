<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
//use yii\bootstrap\ActiveForm;
use frontend\models\Type;
use frontend\models\SubType;
use frontend\models\TypeClinic;
use yii\bootstrap\Tabs;
use yii\web\JsExpression;
use kartik\widgets\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Risk */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="tabon">
    <?php
    echo Tabs::widget([
        'items' => [
            [
                'label' => 'ภาพรวม',
                'url' => 'index.php?r=site/index',
            ],
            /* [
              'label' => 'เขียนใขความเสี่ยง',
              'content' => 'Anim pariatur cliche...',
              'headerOptions' => [],
              'options' => ['id' => 'myveryownID'],
              ], */
            [
                'label' => 'เขียนใบความเสี่ยง',
                'url' => 'index.php?r=risk/create',
                'active' => true
            ],
            [
                'label' => 'บริหารจัดการความเสี่ยง',
                'url' => 'index.php?r=risk/index',
            ],
        /* [
          'label' => 'Dropdown',
          'items' => [
          [
          'label' => 'DropdownA',
          'content' => 'DropdownA, Anim pariatur cliche...',
          ],
          [
          'label' => 'DropdownB',
          'content' => 'DropdownB, Anim pariatur cliche...',
          ],
          ],
          ], */
        ],
    ]);
    ?>
</div>
</br>

<div class="risk-form">   

    <?php $form = ActiveForm::begin(); ?>

    <div class="risk-form">   
        <div class="panel panel-primary">
            <div class="panel-heading"><center><H2>เขียนใบความเสี่ยง</H2></center></div>
            <div class="panel-body">
                <div class="row">
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

                        <div class="panel panel-success">
                            <div class="panel-heading"></div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="panel panel-success">
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

                                                <!--?=
                                                $form->field($model, 'risk_date')->widget(yii\jui\DatePicker::className(), [
                                                    'name' => 'risk_date',
                                                    'language' => 'th',
                                                    'dateFormat' => 'yyyy-MM-dd',
                                                    'options' => [
                                                        'placeholder' => '',
                                                        //'style' => 'width:250px;',
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
                                                ?-->

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

                                                <?= $form->field($model, 'type_clinic_id')->radioList($model->getItemTypeClinic())->label('ประเภทคลินิค', ['class' => 'label-class']) ?>
                                                <!--?=
                                                //$form->field($model, 'type_clinic_id')->dropDownList(
                                                //        ArrayHelper::map(\frontend\models\TypeClinic::find()->all(), 'id', 'clinic_name'), ['prompt' => ''])
                                                ?-->        


                                            </div>
                                        </div>
                                    </div>




                                    <div class="col-md-4">
                                        <div class="panel panel-success">
                                            <div class="panel-heading"></div>
                                            <div class="panel-body">
                                                <?=
                                                $form->field($model, 'location_riks_id')->dropDownList(
                                                        ArrayHelper::map(\frontend\models\LocationRiks::find()->all(), 'id', 'location_name'), ['prompt' => ''])
                                                ?>                                       

                                                <?=
                                                $form->field($model, 'location_connection_id')->dropDownList(
                                                        ArrayHelper::map(\frontend\models\LocationConnection::find()->all(), 'id', 'location_name'), ['prompt' => ''])
                                                ?> 

                                                <?=
                                                $form->field($model, 'location_report_id')->dropDownList(
                                                        ArrayHelper::map(\frontend\models\LocationReport::find()->all(), 'id', 'location_name'), ['prompt' => ''])
                                                ?>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="col-md-4">
                                        <div class="panel panel-success">
                                            <div class="panel-heading"></div>
                                            <div class="panel-body">
                                                <?=
//Dependent DropDownlist
                                                $form->field($model, 'type_id')->dropDownList(
                                                        ArrayHelper::map(\frontend\models\Type::find()->all(), 'id', 'type_name'), [
                                                    'prompt' => '<============  ประเภทความเสี่ยง  ============>',
                                                    'onchange' => ' 
                                        $.post("index.php?r=sub-type/lists&id=' . '"+$(this).val(), function(data) {        
                                        $("select#risk-sub_type_id").html( data );                        
                                        });'
                                                ]);             //index.php?r=sub-type/lists&id    sub-type คือ Controller
                                                ?>

                                                <?=
                                                $form->field($model, 'sub_type_id')->dropDownList(
                                                        ArrayHelper::map(\frontend\models\SubType::find()->all(), 'id', 'sub_type_name'), [  //แล้วไปทำใน actionLists   'id', 'sub_type_name' ให้ตรง
                                                    'prompt' => '<==========  ประเภทความเสี่ยงย่อย  ==========>',
                                                ]);
                                                ?>

                                                <?=
                                                $form->field($model, 'level_id')->dropDownList(
                                                        ArrayHelper::map(\frontend\models\Level::find()->all(), 'id', 'level_name'), [
                                                    'prompt' => '',
                                                        //'style' => 'width:250px;'
                                                ])
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <!--div class="panel panel-success">
                                        <!--div class="panel-heading"></div-->
                                        <div class="panel-body">
                                            <?= $form->field($model, 'risk_summary')->textarea(['rows' => 3]) ?>
                                            <!--/div-->
                                        </div>
                                    </div>
                                </div>




                            </div>
                        </div>


                        <div class="panel panel-danger">
                            <div class="panel-heading"></div>
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
                                        <!--?=
                                        $form->field($model, 'status_id')->dropDownList(
                                                ArrayHelper::map(\frontend\models\Status::find()->all(), 'id', 'status_name'), ['prompt' => ''])
                                        ?-->

                                        <?= $form->field($model, 'status_id')->radioList($model->getItemStatus())->label('การทบทวน', ['class' => 'label-class']) ?>
                                    </div> 


                                    <?php if (Yii::$app->user->identity->role == 20 || Yii::$app->user->identity->role == 30) {
                                        ?>
                                        <div class = "col-md-12">
                                            <?=
                                            $form->field($model, 'risk_review')->textarea(['rows' => 3])
                                            ?>
                                        </div>


                                        <?php
                                    } else {
                                        ?>

                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'บันทึก', ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-success') . ' btn-lg btn-block']) ?>
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