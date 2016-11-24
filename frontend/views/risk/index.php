<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
//use yii\widgets\Pjax;
use kartik\grid\DataColumn;
use yii\grid\ActionColumn;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\grid\BooleanColumn;
use frontend\models\Risk;
use frontend\models\RiskSearch;
use yii\bootstrap\Tabs;
use kartik\export\ExportMenu;
use dosamigos\datepicker\DatePicker;
use dixonsatit\thaiYearFormatter\ThaiYearFormatter;

//use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RiskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'บริหารจัดการความเสี่ยง';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="risk-index">
    <!--?= VarDumper::dump($model,10,true); ?-->
    <!--h1><!--?= Html::encode($this->title) ?></h1-->

    <!--p>
    <!--?= Html::a('Create Risk', ['create'], ['class' => 'btn btn-success']) ?>
    </p-->


    <div class="panel panel-primary">
        <div class="panel-heading"><center><H3><?= Html::img('./../images/mana.jpg'); ?>&nbsp;&nbsp;จัดการความเสี่ยง</H3></center></div>
        <div class="panel-body">

            <center>
                <!--?php echo $this->render('_search', ['model' => $searchModel]); ?-->
                <?php echo yii\helpers\Html::img('../images/risk_level.jpg'); ?>
            </center>

            <p>
                <!--?= Html::a('Create Referout', ['create'], ['class' => 'btn btn-success']) ?-->
            </p>

            <?=
            \kartik\grid\GridView::widget([
                //GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'responsive' => true,
                'hover' => true,
                'floatHeader' => false,
                /* 'pjax' => true,
                  'pjaxSettings' => [
                  'neverTimeout' => true,
                  'enablePushState' => false,
                  //'beforeGrid' => 'My fancy content before.',
                  //'afterGrid' => 'My fancy content after.',
                  //'options' => ['id' => 'CustomerGrid'],
                  ], */
                /* 'pager' => [
                  'class' => \kop\y2sp\ScrollPager::className(),
                  'container' => '.grid-view tbody',
                  'item' => 'tr',
                  'paginationSelector' => '.grid-view .pagination',
                  'triggerTemplate' => '<tr class="ias-trigger"><td colspan="100%" style="text-align: center"><a style="cursor: pointer">{text}</a></td></tr>',
                  ], */
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
            if ($model->level_id == '1') {
                return ['style' => 'background-color:#F5F5F0'];
            }
            if ($model->level_id == '2') {
                return ['style' => 'background-color:#F5F5F0'];
            }
            if ($model->level_id == '3') {
                return ['style' => 'background-color:#C2F0C2'];
            }
            if ($model->level_id == '4') {
                return ['style' => 'background-color:#C2F0C2'];
            }
            if ($model->level_id == '5') {
                return ['style' => 'background-color:#FFFFCC'];
            }
            if ($model->level_id == '6') {
                return ['style' => 'background-color:#FFFFCC'];
            }
            if ($model->level_id == '7') {
                return ['style' => 'background-color:#FFBDA7'];
            }
            if ($model->level_id == '8') {
                return ['style' => 'background-color:#FFBDA7'];
            }
            if ($model->level_id == '9') {
                return ['style' => 'background-color:#FFBDA7'];
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
                        'attribute' => 'id',
                        'header' => 'เลขที่ความเสี่ยง',
                        'options' => ['width' => '10'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                    /*[
                        'attribute' => 'risk_date',
                        'value' => 'risk_report',
                        'format' => 'html',
                        'width' => '40px',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'filterType' => \kartik\grid\GridView::FILTER_DATE_RANGE,
                        'filterWidgetOptions' => [
                            'presetDropdown' => false,
                            'language' => 'th',
                            'pluginOptions' => [
                                'format' => 'dd-M-yyyy H:ii P',
                                'separator' => ' TO ',
                                'opens' => 'left',
                            ],
                            'pluginEvents' => [
                                "apply.daterangepicker" => "function() { apply_filter('date') }",
                            ]
                        ],
                    ],*/
                    /* [
                      'attribute' => 'risk_date',
                      'options' => ['width' => '40'],
                      'contentOptions' => ['class' => 'text-center'],
                      'headerOptions' => ['class' => 'text-center'],
                      'format' => 'raw',
                      'value' => 'risk_date',
                      'filter' => DatePicker::widget([
                      'model' => $searchModel,
                      'language' => 'th',
                      'attribute' => 'risk_date',
                      'clientOptions' => [
                      'autoclose' => true,
                      'format' => 'yyyy-mm-dd'
                      ]
                      ]),
                      //'value' => function($model) {
                      //return Yii::$app->thaiFormatter->asDateTime($model->risk_date, 'medium');  //แสดงผล short,medium,long,full
                      // return Yii::$app->formatter->asDateTime(time(), 'php:F'
                      // return Yii::$app->formatter->asDateTime('2015-06-01', 'php:F'
                      //return Yii::$app->formatter->asDatetime($model->risk_date, 'medium');  //แสดงผล short,medium,long,full
                      //}
                      ], */
                    /*     [
                      'attribute' => 'risk_date',
                      'options' => ['width' => '100'],
                      'value' => 'risk_date',
                      'format' => 'raw',
                      'filter' => DatePicker::widget([
                      'model' => $searchModel,
                      'language' => 'th',
                      'attribute' => 'risk_date',
                      'clientOptions' => [
                      'autoclose' => true,
                      'format' => 'yyyy-mm-dd'
                      ]
                      ]),
                      ], */
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
                        'options' => ['width' => '50'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                        'filter' => Html::activeDropDownList($searchModel, 'location_riks_id', ArrayHelper::map(frontend\models\LocationRiks::find()->asArray()->all(), 'id', 'location_name'), [
                            'class' => 'form-control',
                            'prompt' => ''
                        ]),
                    ],
                    //'location_connection_id',
                    //search แบบกรอกข้อมความในช่อง แล้วไปแก้ riskSearch
                    /* [
                      'attribute' => 'location_connection_id',
                      'value' => 'locationConnection.location_name',
                      'options' => ['width' => '50'],
                      'filter' => Html::activeDropDownList($searchModel, 'location_connection_id', ArrayHelper::map(frontend\models\LocationConnection::find()->asArray()->all(), 'id', 'location_name'), [
                      'class' => 'form-control',
                      'prompt' => ''
                      ]
                      ),
                      'headerOptions' => ['class' => 'text-center'],
                      'contentOptions' => ['class' => 'text-center'],
                      //'headerOptions' => ['width' => '80']
                      ], */
                    [
                        'attribute' => 'location_report_id',
                        'value' => 'locationReport.location_name',
                        'options' => ['width' => '50'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                        'filter' => Html::activeDropDownList($searchModel, 'location_report_id', ArrayHelper::map(frontend\models\LocationReport::find()->asArray()->all(), 'id', 'location_name'), [
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
                        'options' => ['width' => '3000'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                    //'type_id',
                    [
                        'attribute' => 'type_id',
                        'value' => 'type.type_name',
                        'options' => ['width' => '50'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
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
                    /* [
                      'attribute' => 'type_clinic_id',
                      'value' => 'typeClinic.clinic_name',
                      'contentOptions' => ['class' => 'text-center'],
                      'headerOptions' => ['class' => 'text-center'],
                      'filter' => Risk::itemsAlias2('type_clinic_id'),
                      ], */
                    //'level_id',
                    [
                        'attribute' => 'level_id',
                        'value' => 'level.level_e',
                        'options' => ['width' => '20'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                        'filter' => Html::activeDropDownList($searchModel, 'level_id', ArrayHelper::map(frontend\models\Level::find()->asArray()->all(), 'id', 'level_e'), [
                            'class' => 'form-control', 'prompt' => ''
                        ]),
                    ],
                    //'clear_id',
                    //'system_id',
                    // แสดงข้อมูลออกเป็น icon
                    [
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
                    [
                        'attribute' => 'risk_review',
                        'options' => ['width' => '100'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                    //'StatusName',   //Virtual Attribute เอาไว้แสดงข้อมูลใน Gridview
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
                        'header' => 'พิมพ์',
                        'options' => ['width' => '50'],
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                        //'options' => ['style' => 'width:200px;'],
                        'template' => '<div class="btn-group btn-group-sm" role="group" aria-label="...">{pdf}</div>',
                        'buttons' => [
                            'pdf' => function($url, $model, $key) {
                                return Html::a('<i class="glyphicon glyphicon-print"></i>', $url, ['class' => 'btn btn-success btn-lg', 'title' => 'Print', 'target' => '_blank']);
                            },
                                /* 'delete' => function($url, $model, $key) {
                                  return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, [
                                  'title' => Yii::t('yii', 'Delete'),
                                  'data-confirm' => Yii::t('yii', 'ยืนยันการลบข้อมูล'),
                                  'data-method' => 'post',
                                  'data-pjax' => '0',
                                  'class' => 'btn btn-default'
                                  ]);
                                  } */
                                ]
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                //'header' => 'ทบทวน/เอกสาร/ลบ',
                                //'header' => 'ทบทวน/เอกสาร',
                                'header' => 'ทบทวน',
                                'options' => ['width' => '100'],
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                                //'options' => ['style' => 'width:200px;'],
                                //'template' => '<div class="btn-group btn-group-sm" role="group" aria-label="...">{update}{view}{delete}</div>',
                                //'template' => '<div class="btn-group btn-group-sm" role="group" aria-label="...">{update}{view}</div>',
                                'template' => '<div class="btn-group btn-group-sm" role="group" aria-label="...">{update}</div>',
                                'buttons' => [
                                    /*'view' => function($url, $model, $key) {
                                        return Html::a('<i class="glyphicon glyphicon glyphicon-paste"></i>', $url, ['class' => 'btn btn-default']);
                                        //return Html::a('<i class="glyphicon glyphicon-print"></i>', $url, ['class' => 'btn btn-default']);
                                    },*/
                                            'update' => function($url, $model, $key) {
                                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, ['class' => 'btn btn-default', 'target' => '_blank']);
                                    },
                                        /* 'delete' => function($url, $model, $key) {
                                          return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, [
                                          'title' => Yii::t('yii', 'Delete'),
                                          'data-confirm' => Yii::t('yii', 'ยืนยันการลบข้อมูล'),
                                          'data-method' => 'post',
                                          'data-pjax' => '0',
                                          'class' => 'btn btn-default'
                                          ]);
                                          } */
                                        ]
                                    ],
                                ],
                            ]);
                            ?>

        </div>
    </div>
</div>


<script type="text/javascript">
    function apply_filter() {

        $('.grid-view').yiiGridView('applyFilter');

    }
</script>
