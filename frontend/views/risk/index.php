<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use kartik\grid\DataColumn;
use yii\grid\ActionColumn;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\grid\BooleanColumn;
use frontend\models\Risk;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RiskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'บริหารจัดการความเสี่ยง';
//$this->params['breadcrumbs'][] = $this->title;
?>


<div class="risk-index">

    <!--h1><!--?= Html::encode($this->title) ?></h1-->

    <!--p>
    <!--?= Html::a('Create Risk', ['create'], ['class' => 'btn btn-success']) ?>
    </p-->


    <div class="panel panel-primary">
        <div class="panel-heading"><center><H2>จัดการความเสี่ยง</H2></center></div>
        <div class="panel-body">

            <!--div class="row">
                <div class="col-md-4">
            <!--?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div-->

            <?php Pjax::begin(); ?>
            <?=
            \kartik\grid\GridView::widget([
                //GridView::widget([
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
                    'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> RM</h3>',
                    //'type' => 'success',
                    'before' => '',
                    'after' => '',
                //'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
                //'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
                //'footer' => false
                ],
                'rowOptions' => function($model) {     //adding row gridview
            if ($model->level_id == '3') {
                return ['class' => 'success'];
            }
            if ($model->level_id == '4') {
                return ['class' => 'success'];
            }
            if ($model->level_id == '5') {
                return ['class' => 'warning'];
            }
            if ($model->level_id == '6') {
                return ['class' => 'warning'];
            }
            if ($model->level_id == '7') {
                return ['class' => 'danger'];
            }
            if ($model->level_id == '8') {
                return ['class' => 'danger'];
            }
            if ($model->level_id == '9') {
                return ['class' => 'danger'];
            }
        },
                'columns' => [
                    [
                        'header' => 'ลำดับ',
                        'class' => 'yii\grid\SerialColumn',
                        'options' => ['width' => '5'],
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center']
                    ],
                    [
                        'attribute' => 'risk_date',
                        'options' => ['width' => '50'],
                        'headerOptions' => ['class' => 'text-center'],
                        'value' => function($model) {
                    return Yii::$app->formatter->asDate($model->risk_date, 'medium');  //แสดงผล short,medium,long,full
                    //return Yii::$app->formatter->asDatetime($model->risk_date, 'medium');  //แสดงผล short,medium,long,full
                }
                    ],
                    //'id',
                    //'person_id',
                    //'risk_date',
                    /* [
                      'attribute' => 'risk_date',
                      'format' => 'date',
                      'label' => 'วันที่เกิดเหตุ',
                      ], */
                    //'risk_report',
                    //'hn',
                    /* [
                      'attribute' => 'hn',
                      'headerOptions' => ['width' => '100', 'class' => 'text-center'],
                      'contentOptions' => ['class' => 'text-center'],
                      ], */
                    //'hn:text:HN', //เขียนแบบย่อ
                    /* [
                      'attribute' => 'hn',
                      'options' => ['width' => '50'],
                      'headerOptions' => ['class' => 'text-center'],
                      ], */
                    //'pname',
                    //'fname',
                    //'lname',
                    //'location_riks_id',
                    [
                        'attribute' => 'location_riks_id',
                        'value' => 'locationRiks.location_name',
                        'filter' => Html::activeDropDownList($searchModel, 'location_riks_id', ArrayHelper::map(frontend\models\LocationRiks::find()->asArray()->all(), 'id', 'location_name'), [
                            'class' => 'form-control', 'prompt' => ''
                        ]),
                    ],
                    //'location_connection_id',
                    /*
                     * search แบบกรอกข้อมความในช่อง แล้วไปแก้ riskSearch
                     * [
                      'attribute' => 'location_connection_id',
                      'value' => 'locationConnection.location_name',
                      'options' => ['width' => '50'],
                      //'filter' => Html::activeDropDownList($searchModel, 'location_riks_id', ArrayHelper::map(Risk::find()->asArray()->all(), 'ID', 'location_riks_id'),['class'=>'form-control','prompt' => 'Select Category']),
                      'headerOptions' => ['class' => 'text-center'],
                      'contentOptions' => ['class' => 'text-center'],
                      //'headerOptions' => ['width' => '80']
                      ], */
                    [
                        'attribute' => 'location_connection_id',
                        'value' => 'locationConnection.location_name',
                        'filter' => Html::activeDropDownList($searchModel, 'location_connection_id', ArrayHelper::map(frontend\models\LocationConnection::find()->asArray()->all(), 'id', 'location_name'), [
                            'class' => 'form-control', 'prompt' => ''
                        ]),
                    ],
                    //'location_report_id',
                    /* [
                      'attribute' => 'location_report_id',
                      'value' => 'locationReport.location_name',
                      //'headerOptions' => ['width' => '80'],
                      ], */
                    //'risk_report',
                    [
                        'attribute' => 'risk_summary',
                        'options' => ['width' => '1500'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                    //'type_id',
                    [
                        'attribute' => 'type_id',
                        'value' => 'type.type_name',
                        'filter' => Html::activeDropDownList($searchModel, 'type_id', ArrayHelper::map(frontend\models\Type::find()->asArray()->all(), 'id', 'type_name'), [
                            'class' => 'form-control', 'prompt' => ''
                        ]),
                    ],
                    //'sub_type_id',
                    /* [
                      'attribute' => 'sub_type_id',
                      'value' => 'subType.sub_type_name',
                      'filter' => Html::activeDropDownList($searchModel, 'sub_type_id', ArrayHelper::map(frontend\models\SubType::find()->asArray()->all(), 'id', 'sub_type_name'), [
                      'class' => 'form-control', 'prompt' => ''
                      ]),
                      ], */
                    [
                        'attribute' => 'type_clinic_id',
                        'value' => 'typeClinic.clinic_name',
                        'filter' => Risk::itemsAlias2('type_clinic_id'),
                    ],
                    //'level_id',
                    [
                        'attribute' => 'level_id',
                        'value' => 'level.level_e',
                        'filter' => Html::activeDropDownList($searchModel, 'level_id', ArrayHelper::map(frontend\models\Level::find()->asArray()->all(), 'id', 'level_e'), [
                            'class' => 'form-control', 'prompt' => ''
                        ]),
                    ],
                    //'clear_id',
                    //'system_id',
                    [   // แสดงข้อมูลออกเป็น icon
                        'attribute' => 'status_id',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                        'filter' => Risk::itemsAlias('status_id'),
                        'options' => ['width' => '100'],
                        //'filter' => frontend\models\Risk::itemsAlias("status_id"),
                        //'filter' => frontend\models\Status::find()->all(), 'id', 'status_name',
                        'value' => function($model, $key, $index, $column) {
                    return $model->status_id == 2 ? "<i class=\"fa fa-thumbs-o-up fa-2x\"></i>" : "<i class=\"fa fa-spinner fa-pulse fa-2x\"></i>";
                }
                    ],
                    /* [
                      'class' => '\kartik\grid\BooleanColumn',
                      'attribute' => 'status_id',
                      //'value' => 'status.status_name',
                      'value' => function($model, $key, $index, $column) {
                      return $model->status_id == 2 ? "<i class=\"glyphicon glyphicon-ok\"></i>" : "<i class=\"glyphicon glyphicon-remove\"></i>";
                      },
                      //'value'=>function($data) { return $data->status_id; },
                      'vAlign' => 'middle',
                      'trueLabel' => 'Yes',
                      'falseLabel' => 'No'
                      ], */
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'ทบทวน / เอกสาร / ลบ',
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                        //'options' => ['style' => 'width:200px;'],
                        'template' => '<div class="btn-group btn-group-sm" role="group" aria-label="...">{update}{view}{delete}</div>',
                        'buttons' => [
                            'view' => function($url, $model, $key) {
                                return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', $url, ['class' => 'btn btn-default']);
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
                    <?php Pjax::end(); ?>

        </div>
    </div>
</div>
