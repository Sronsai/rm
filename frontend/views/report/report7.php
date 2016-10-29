<?php
/* @var $this yii\web\View */

use fedemotta\datatables\DataTables;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use miloschuman\highcharts\Highcharts;

$this->title = '10 อันดับหน่วยที่รายงานความเสี่ยง';

//use yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => '10 อันดับหน่วยที่รายงานความเสี่ยง', 'url' => ['/report/report7']];
$this->params['breadcrumbs'][] = '10 อันดับหน่วยที่รายงานความเสี่ยง';
?>

<div class="report">
    <center><h1><u>10 อันดับหน่วยที่รายงานความเสี่ยง</u></h1></center>


    <div class='well'>
        <!--h4><i class="icon fa fa-bar-chart"></i> รายการความเสี่ยงทั้งหมด</h4-->
        <form method="POST">

            <div id="div3">ระหว่าง :</div>
            <div id="div1">
                <?=
                yii\jui\DatePicker::widget([
                    'name' => 'date1',
                    'value' => $date1,
                    'language' => 'th',
                    'dateFormat' => 'yyyy-MM-dd',
                    'options' => [
                        'placeholder' => '',
                        'style' => 'width:130px;',
                        'class' => 'form-control',
                        'changeMonth' => true,
                        'changeYear' => true,
                        'yearRange' => '1996:2099',
                        'showOn' => 'button',
                        'buttonImageOnly' => true,
                        'buttonText' => 'Select date'
                    ],
                ]);
                ?>


            </div>
            <div id="div4">ถึง</div>
            <div id="div2">
                <?=
                yii\jui\DatePicker::widget([
                    'name' => 'date2',
                    'value' => $date2,
                    'language' => 'th',
                    'dateFormat' => 'yyyy-MM-dd',
                    'options' => [
                        'placeholder' => '',
                        'style' => 'width:130px;',
                        'class' => 'form-control',
                        'changeMonth' => true,
                        'changeYear' => true,
                        'yearRange' => '1996:2099',
                        'showOn' => 'button',
                        'buttonImageOnly' => true,
                        'buttonText' => 'Select date'
                    ],
                ]);
                ?>
            </div>

            <button class='btn btn-success'>ประมวลผล</button>


        </form>


    </div>



    <!-- chart -->
    <div class="panel-body">
        <div class="col-md-12">
            <div style="display: none">
                <?php
                echo Highcharts::widget([
                    'scripts' => [
                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                        'modules/exporting', // adds Exporting button/menu to chart
                        //'themes/grid', // applies global 'grid' theme to all charts
                        'highcharts-3d',
                        'modules/drilldown'
                    ]
                ]);
                ?>
            </div>
            <div id="chart1">
            </div>

            <?php
            $this->registerJs("$(function () { 
                                    Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
                                        return {
                                            radialGradient: {
                                                cx: 0.5,
                                                cy: 0.3,
                                                r: 0.7
                                            },
                                            stops: [
                                            [0, color],
                                            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                                            ]
                                        };
                                    });

                                    $('#chart1').highcharts({
                                        chart: {
                                            type: 'column',
                                            margin: 75,
                                            options3d: {   
                                                enabled: true,
                                                alpha: 10,
                                                beta: 15,
                                                depth: 70
                                            }
                                        },
                                        title: {
                                            text: '10 อันดับหน่วยที่รายงานความเสี่ยง'
                                        },
                                        plotOptions: {
                                            pie: {
                                                allowPointSelect: true,
                                                cursor: 'pointer',
                                                depth: 35,
                                                dataLabels: {
                                                    enabled: true,
                                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                                    style: {
                                                        color:'black'                     
                                                    },
                                                    connectorColor: 'silver'
                                                }
                                            }
                                        },
                                        xAxis: {
                                            type: 'category'
                                        },
                                        yAxis: {
                                            title: {
                                                text: '<b>ครั้ง</b>'
                                            },
                                        },
                                        legend: {
                                            enabled: true
                                        },
                                        plotOptions: {
                                            series: {
                                                borderWidth: 0,
                                                dataLabels: {
                                                    enabled: true
                                                }
                                            }
                                        },
                                        series: [
                                        {
                                            name: 'ครั้ง',
                                            colorByPoint: true,
                                            data:$main

                                        }
                                        ],
                                    });
                                });");
            ?>   
        </div>
    </div>
    <!-- end chart -->


    <div class="panel panel-default">
        <div class="panel-body">
            <?php
            if (isset($dataProvider))
                $dev = \yii\helpers\Html::a('คุณดนัย สอนไสย', 'https://fb.com/foyplvowlp', ['target' => '_blank']);


//echo yii\grid\GridView::widget([
            echo \kartik\grid\GridView::widget([
                //echo DataTables::widget([
                'dataProvider' => $dataProvider,
                //'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '0'],
                'panel' => [
                    'before' => ''
                ],
                'export' => [
                    'showConfirmAlert' => false,
                    'target' => GridView::TARGET_BLANK
                ],
                //'dataProvider' => $dataProvider,
                //'responsive' => TRUE,
                //'hover' => true,
                //'floatHeader' => true,
                //'panel' => [
                //'before' => 'ประมวลผลข้อมูล จากวันที่  ' . $date1 . '   ถึงวันที่   ' . $date2 . '',
                //'type' => \kartik\grid\GridView::TYPE_SUCCESS,
                //'after' => 'โดย ' . $dev
                //],
                'columns' => [
                    /* [
                      'attribute' => 'risk_date',
                      'header' => 'วันที่เกิดเหตุ',
                      'headerOptions' => ['width' => '80']
                      ],
                      [
                      'attribute' => 'id',
                      'header' => 'เลขที่',
                      'headerOptions' => ['width' => '30']
                      ], */
                    [
                        'attribute' => 'location_name',
                        'header' => 'หน่วยงานที่รายงานความเสี่ยง',
                        'headerOptions' => ['width' => '20']
                    ],
                    [
                        'attribute' => 'total',
                        'header' => 'จำนวนครั้ง',
                        'headerOptions' => ['width' => '100']
                    ],
                /* [
                  'attribute' => 'location_name',
                  'header' => 'หน่วยงานที่เกิดเหตุ',
                  'headerOptions' => ['width' => '100']
                  ],
                  /* [
                  'attribute' => 'connection',
                  'header' => 'หน่วยงานที่เกี่ยวข้อง',
                  'headerOptions' => ['width' => '130']
                  ],
                  [
                  'attribute' => 'report',
                  'header' => 'หน่วยงานที่รายงาน',
                  'headerOptions' => ['width' => '130']
                  ],
                  [
                  'attribute' => 'risk_summary',
                  'header' => 'รายละเอียดความเสี่ยง',
                  'headerOptions' => ['width' => '100']
                  ],
                  [
                  'attribute' => 'type',
                  'header' => 'ประเภท',
                  'headerOptions' => ['width' => '100']
                  ],
                  [
                  'attribute' => 'level_e',
                  'header' => 'ระดับ',
                  'headerOptions' => ['width' => '20']
                  ],
                  [
                  'attribute' => 'risk_review',
                  'header' => 'สรุปการทบทวน / แนวทาง',
                  'headerOptions' => ['width' => '100']
                  ],
                  [
                  'attribute' => 'status',
                  'header' => 'ทบทวน',
                  'headerOptions' => ['width' => '70']
                  ], */
                ],
                    /* 'clientOptions' => [
                      "lengthMenu" => [[15, -1], [15, Yii::t('app', "All")]], //20 Rows
                      "info" => TRUE,
                      "responsive" => true,
                      "dom" => 'lfTrtip',
                      "tableTools" => [
                      "aButtons" => [
                      [
                      "sExtends" => "copy",
                      "sButtonText" => Yii::t('app', "Copy to clipboard")
                      ], [
                      "sExtends" => "csv",
                      "sButtonText" => Yii::t('app', "Save to CSV")
                      ], [
                      "sExtends" => "xls",
                      "oSelectorOpts" => ["page" => 'current']
                      ], [
                      "sExtends" => "pdf",
                      "sButtonText" => Yii::t('app', "Save to PDF")
                      ], [
                      "sExtends" => "print",
                      "sButtonText" => Yii::t('app', "Print")
                      ],
                      ]
                      ]
                      ] */
            ]);
            ?>
        </div>
    </div>

    <?php
    $script = <<< JS
$('#btn_sql').on('click', function(e) {

   $('#sql').toggle();
});
JS;
    $this->registerJs($script);
    ?>

</div>

