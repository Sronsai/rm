<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ReferoutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ทะเบียน Refer';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referout-index">

    <div class="panel panel-primary">
        <div class="panel-heading"><center><H3>ทบทวนเคส Refer</H3></center></div>
        <div class="panel-body">

            <center>
                <?php echo yii\helpers\Html::img('../images/refer.jpg'); ?>
            </center>
            
            <?php // echo $this->render('_search', ['model' => $searchModel]);    ?>

            <p>
                <!--?= Html::a('Create Referout', ['create'], ['class' => 'btn btn-success']) ?-->
            </p>

            <?=
            \kartik\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'responsive' => true,
                'hover' => true,
                'floatHeader' => false,
                'pjax' => true,
                'pjaxSettings' => [
                'neverTimeout' => true,
                'enablePushState' => false,
                //'beforeGrid' => 'My fancy content before.',
                //'afterGrid' => 'My fancy content after.',
                //'options' => ['id' => 'CustomerGrid'],
                ],
                'panel' => [
                    //'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> RM</h3>',
                    //'type' => 'info',
                'before' => '',
                'after' => '',
                //'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
                //'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
                //'footer' => false
                ],
                'rowOptions' => function($model) {     //adding row gridview
                    if ($model->strength_id == '05') {
                        return ['style' => 'background-color:#F5F5F0'];  //เทา
                    }
                    if ($model->strength_id == '04') {
                        return ['style' => 'background-color:#C2F0C2'];  //เขียว
                    }
                    if ($model->strength_id == '03') {
                        return ['style' => 'background-color:#FFFFCC'];  //เหลือง
                    }
                    if ($model->strength_id == '02') {
                        return ['style' => 'background-color:#EAD4FF'];  //ม่วง
                    }
                    if ($model->strength_id == '01') {
                        return ['style' => 'background-color:#FFBDA7'];  //แดง
                    }
                },
                'columns' => [
                [
                'class' => 'yii\grid\SerialColumn',
                'header' => 'ลำดับ',
                'options' => ['width' => '20'],
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                ],
                            //'refer_no',
                            //'refertype_id',
                            //'refer_date',
                [
                'attribute' => 'refer_date',
                'options' => ['width' => '50'],
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'value' => 'refer_date',
                'format' => 'raw',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'language' => 'th',
                    'attribute' => 'refer_date',
                    'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                    ]
                    ]),
                ],
                            /* [
                              'attribute' => 'refer_date',
                              'options' => ['width' => '90'],
                              'headerOptions' => ['class' => 'text-center'],
                              'contentOptions' => ['class' => 'text-center'],
                              ], */
                              /*[
                              'attribute' => 'refer_time',
                              'options' => ['width' => '20'],
                              'headerOptions' => ['class' => 'text-center'],
                              'contentOptions' => ['class' => 'text-center'],
                              ],*/
                            //'station_id',
                            // 'location_id',
                            // 'cid',
                            //'hn',
                              [
                              'attribute' => 'hn',
                              'options' => ['width' => '50'],
                              'headerOptions' => ['class' => 'text-center'],
                              'contentOptions' => ['class' => 'text-center'],
                              ],
                              [
                              'attribute' => 'station_name',
                              'options' => ['width' => '50'],
                              'headerOptions' => ['class' => 'text-center'],
                              'contentOptions' => ['class' => 'text-center'],
                              'filter' => Html::activeDropDownList($searchModel, 'station_name', ArrayHelper::map(frontend\models\Referout::find()->asArray()->all(), 'station_name', 'station_name'), [
                                'class' => 'form-control', 
                                'prompt' => ''
                                ]),
                              ],
                            //'pname',
                            //'fname',
                            //'lname',
                            // 'age',
                            // 'addrpart',
                            // 'moopart',
                            // 'tmbpart',
                            // 'amppart',
                            // 'chwpart',
                            //'pttype_id',
                            // 'pttypeno',
                            // 'hospmain',
                            // 'hospsub',
                            //'typept_id',
                              [
                              'attribute' => 'cause_referout_id',
                              'value' => 'causereferout.cause_referout_name',
                              'options' => ['width' => '100'],
                              'contentOptions' => ['class' => 'text-center'],
                              'headerOptions' => ['class' => 'text-center'],
                              'filter' => Html::activeDropDownList($searchModel, 'cause_referout_id', ArrayHelper::map(frontend\models\CauseReferout::find()->asArray()->all(), 'cause_referout_id', 'cause_referout_name'), [
                                'class' => 'form-control', 'prompt' => ''
                                ]),
                              ],
                              [
                              'attribute' => 'typept_id',
                              'value' => 'typept.typept_name',
                              'options' => ['width' => '100'],
                              'headerOptions' => ['class' => 'text-center'],
                              'contentOptions' => ['class' => 'text-center'],
                              'filter' => Html::activeDropDownList($searchModel, 'typept_id', ArrayHelper::map(frontend\models\Typept::find()->asArray()->all(), 'typept_id', 'typept_name'), [
                                'class' => 'form-control', 'prompt' => ''
                                ]),
                              ],
                            //'strength_id',
                              [
                              'attribute' => 'strength_id',
                              'value' => 'strength.strength_name',
                              'options' => ['width' => '100'],
                              'contentOptions' => ['class' => 'text-center'],
                              'headerOptions' => ['class' => 'text-center'],
                              'filter' => Html::activeDropDownList($searchModel, 'strength_id', ArrayHelper::map(frontend\models\Strength::find()->asArray()->all(), 'strength_id', 'strength_name'), [
                                'class' => 'form-control', 'prompt' => ''
                                ]),
                              ],
                            // 'doctor_id',
                            // 'refer_hospcode',
                            // 'expire_date',
                            // 'loads_id',
                            // 'is_coordinate_doctor',
                            // 'is_coordinate_nurse',
                            // 'coordinate_id',
                            // 'image1',
                            // 'is_upload',
                            // 'is_download',
                            // 'is_receive',
                            // 'image2',
                            // 'image3',
                            // 'image4',
                            // 'image5',
                            // 'sex',
                            // 'is_coordinate_not',
                            // 'is_coordinate_no',
                            // 'memo:ntext',
                            //'memodiag:ntext',
                              [
                              'attribute' => 'memodiag',
                              'options' => ['width' => '100'],
                              'headerOptions' => ['class' => 'text-center'],
                              ],
                            //'drugallergy',             
                            //'cc',
                              [
                              'attribute' => 'cc',
                              'options' => ['width' => '500'],
                              'headerOptions' => ['class' => 'text-center'],
                              ],         
                             [// แสดงข้อมูลออกเป็น icon
                             'attribute' => 'status_id',
                             'format' => 'html',
                             'contentOptions' => ['class' => 'text-center'],
                             'headerOptions' => ['class' => 'text-center'],
                             'filter' => \frontend\models\Referout::itemsAlias('status_id'),
                             'options' => ['width' => '100'],
                                //'filter' => frontend\models\Risk::itemsAlias("status_id"),
                                //'filter' => frontend\models\Status::find()->all(), 'id', 'status_name',
                             'value' => function($model, $key, $index, $column) {
                                return $model->status_id == 2 ? "<i class=\"fa fa-thumbs-o-up fa-2x\"></i>" : "<i class=\"fa fa-spinner fa-pulse fa-2x\"></i>";
                            }
                            ],                  
                            [
                            'attribute' => 'refer_status',
                            'options' => ['width' => '500'],
                            'headerOptions' => ['class' => 'text-center'],
                            ],
                            /* [
                              'class' => 'kartik\grid\FormulaColumn',
                              'attribute' => 'is_dead_refer',
                              'options' => ['width' => '10'],
                              'headerOptions' => ['class' => 'text-center'],
                              'mergeHeader' => true,
                              'width' => '150px',
                              'hAlign' => 'center',
                              'pageSummary' => true
                              ],
                              //'is_dead_er',
                              [
                              'class' => 'kartik\grid\FormulaColumn',
                              'attribute' => 'is_dead_er',
                              'options' => ['width' => '10'],
                              'headerOptions' => ['class' => 'text-center'],
                              'mergeHeader' => true,
                              'width' => '150px',
                              'hAlign' => 'center',
                              'pageSummary' => true
                              ], */
                            /* [
                              'attribute' => 'is_dead_refer',
                              'options' => ['width' => '3'],
                              'headerOptions' => ['class' => 'text-center'],
                              'contentOptions' => ['class' => 'text-center'],
                              'filter' => Html::activeDropDownList($searchModel, 'is_dead_refer', ArrayHelper::map(frontend\models\Referout::find()->asArray()->all(), 'is_dead_refer', 'is_dead_refer'), ['class' => 'form-control', 'prompt' => '']),
                              ], */
                            //'is_dead_er',
                            /* [
                              'attribute' => 'is_dead_er',
                              'options' => ['width' => '3'],
                              'headerOptions' => ['class' => 'text-center'],
                              'contentOptions' => ['class' => 'text-center'],
                              'filter' => Html::activeDropDownList($searchModel, 'is_dead_er', ArrayHelper::map(frontend\models\Referout::find()->asArray()->all(), 'is_dead_er', 'is_dead_er'), ['class' => 'form-control', 'prompt' => '']),
                              ],
                              [
                              'attribute' => 'is_dead_ward',
                              'options' => ['width' => '3'],
                              'headerOptions' => ['class' => 'text-center'],
                              'contentOptions' => ['class' => 'text-center'],
                              'filter' => Html::activeDropDownList($searchModel, 'is_dead_ward', ArrayHelper::map(frontend\models\Referout::find()->asArray()->all(), 'is_dead_ward', 'is_dead_ward'), ['class' => 'form-control', 'prompt' => '']),
                              ], */
                            //'doctor_name',
                            // 'user_save',
                            // 'vn',
                            // 'conscious',
                            // 'e',
                            // 'v',
                            // 'm',
                            // 'evm_total',
                            // 'pupil_right',
                            // 'pupil_left',
                            // 't',
                            // 'p',
                            // 'r',
                            // 'bp',
                            // 'Send_spclty_id',
                            // 'load_time',
                            // 'spo2',
                            // 'clinicgroup',
                            // 'clinicsub',
                            // 'load_date',
                            // 'vst_date',
                            // 'station_name',
                            // 'father',
                            // 'mother',
                            // 'location_name',
                            // 'pttype_name',
                            // 'forward_flag',
                            // 'from_hospcode',
                            // 'save_date',
                            // 'save_time',
                            // 'warfarin_note',
                            // 'app_date',
                            // 'ett_no',
                            // 'ett_mark',
                            // 'sync_memo',
                            // 'refer_no_his',
                            // 'level_acute',
                            // 'cause_referout_etc',
                            // 'is_consult',
                              /* ['class' => 'yii\grid\ActionColumn'], */
                              [
                              'class' => 'yii\grid\ActionColumn',
                              'header' => 'ทบทวน',
                              'options' => ['width' => '5'],
                              'headerOptions' => ['class' => 'text-center'],
                              'contentOptions' => ['class' => 'text-center'],
                                //'options' => ['style' => 'width:200px;'],
                              'template' => '<div class="btn-group btn-group-sm" role="group" aria-label="...">{update}</div>',
                              'buttons' => [
                              'view' => function($url, $model, $key) {
                                return Html::a('<i class="glyphicon glyphicon glyphicon-paste"></i>', $url, ['class' => 'btn btn-default']);
                                        //return Html::a('<i class="glyphicon glyphicon-print"></i>', $url, ['class' => 'btn btn-default']);
                            },
                            'update' => function($url, $model, $key) {
                                return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, ['class' => 'btn btn-default']);
                            },
                            'delete' => function($url, $model, $key) {
                                return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, [
                                    'title' => Yii::t('yii', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'ยืนยันการลบข้อมูล'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                    'class' => 'btn btn-default'
                                    ]);
                            }
                            ]
                            ],
                            ],
                            ]);
                            ?>

                        </div>
                    </div>
                </div>
