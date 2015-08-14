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

<div class="tabon">
    <?php
    echo Tabs::widget([
        'items' => [
            [
                'label' => 'ภาพรวม',
                //'content' => 'Anim pariatur cliche...', 
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
            ],
            [
                'label' => 'บริหารจัดการความเสี่ยง',
                'url' => 'index.php?r=risk/index',
                'active' => true
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
</br></br></br>

<div class="risk-index">

    <!--h1><!--?= Html::encode($this->title) ?></h1-->

    <!--p>
    <!--?= Html::a('Create Risk', ['create'], ['class' => 'btn btn-success']) ?>
    </p-->


    <div class="panel panel-primary">
        <div class="panel-heading"><center><H2>บริหารจัดการความเสี่ยง</H2></center></div>     
        <div class="panel-body">

            <div class="row">
                <div class="col-md-4">
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                </div>
            </div>

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
                //'options' => ['id' => 'CustomerGrid'],
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
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center']
                    ],
                    [
                        'attribute' => 'risk_date',
                        'value' => function($model) {
                            return Yii::$app->formatter->asDate($model->risk_date, 'medium');  //แสดงผล short,medium,long,full
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
                    'hn:text:HN', //เขียนแบบย่อ
                    //'pname',
                    //'fname',
                    //'lname',
                    //'location_riks_id',
                    [
                        'attribute' => 'location_riks_id',
                        'value' => 'locationRiks.location_name',
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                    //'headerOptions' => ['width' => '80']
                    ],
                    //'location_connection_id',
                    //'location_report_id',
                    /* [
                      'attribute' => 'location_report_id',
                      'value' => 'locationReport.location_name',
                      //'headerOptions' => ['width' => '80'],
                      ], */
                    //'risk_report',
                    [
                        'attribute' => 'risk_summary',
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                    //'type_id',
                    [
                        'attribute' => 'type_id',
                        'value' => 'type.type_name',
                        'options' => ['width' => '100'],
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                    ],
                    /* 'sub_type_id',
                      [
                      'attribute' => 'sub_type_id',
                      'value' => 'subType.sub_type_name',
                      'headerOptions' => ['class' => 'text-center'],
                      'contentOptions' => ['class' => 'text-center'],
                      ], */
                    //'level_id',
                    [
                        'attribute' => 'level_id',
                        'value' => 'level.level_e',
                        'options' => ['width' => '20'],
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
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
                        'header' => 'ทบทวน / ลบ',
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                        //'options' => ['style' => 'width:200px;'],
                        'template' => '<div class="btn-group btn-group-sm" role="group" aria-label="...">{update}{delete}</div>',
                        'buttons' => [
                            /* 'view' => function($url, $model, $key) {
                              return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', $url, ['class' => 'btn btn-default']);
                              }, */
                            'update' => function($url, $model, $key) {
                                return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, ['class' => 'btn btn-default']);
                            },
                                    'delete' => function($url, $model, $key) {
                                return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, [
                                            'title' => Yii::t('yii', 'Delete'),
                                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
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

