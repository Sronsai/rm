<?php

use miloschuman\highcharts\Highcharts;
//use fedemotta\datatables\DataTables;
use kartik\grid\GridView;
use yii\helpers\Html;
?>


<div class="indications-index">
    <center>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading"><H2>ใบความเสี่ยง ข้อร้องเรียน/ข้อเสนอแนะ 2558</H2></div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li role="presentation" class="active"><a href="?r=report/report9"><H3>ปีงบ 2558</H3></a></li>
                        <li role="presentation"><a href="?r=report/report8"><H3>ปีงบ 2559</H3></a></li>
                        <li role="presentation"><a href="?r=report/report10"><H3>ปีงบ 2560</H3></a></li>
                    </ul>
                    <br />
                    <?=
                    /* GridView::widget([
                      'dataProvider' => $dataProvider,
                      'responsive' => true,
                      'hover' => true,
                      'floatHeader' => false,
                      'pjax' => true,
                      'pjaxSettings' => [
                      'neverTimeout' => true,
                      'enablePushState' => false,
                      ],
                      'panel' => [
                      'before' => '',
                      'after' => '',
                      ], */
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '0'],
                        'showPageSummary' => true,
                        'pjax' => true,
                        'striped' => false,
                        'hover' => true,
                        //'panel' => ['type' => 'primary', 'heading' => 'Grid Grouping Example'],
                        'columns' => [
                            [
                                'attribute' => 'subtypename',
                                'header' => 'ข้อร้องเรียน/ข้อเสนอแนะ',
                                'headerOptions' => ['width' => '300'],
                                'headerOptions' => ['class' => 'text-center'],
                                //'contentOptions' => ['class' => 'text-center'],
                                'pageSummary' => 'ความเสี่ยงทั้งหมด',
                                //'pageSummaryOptions'=>['class'=>'text-left text-danger'],
                                //'pageSummaryOptions' => ['class' => 'text-center'],
                                'group' => true,
                            //'groupedRow'=>true,     
                            //'groupOddCssClass' => 'kv-grouped-row', // configure odd group cell css class
                            //'groupEvenCssClass' => 'kv-grouped-row', // configure even group cell css class
                            ],
                            [
                                'attribute' => 'oct',
                                'header' => 'ต.ค.',
                                'headerOptions' => ['width' => '100'],
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                                'pageSummary' => true,
                                'pageSummaryOptions' => ['class' => 'text-center'],
                            ],
                            [
                                'attribute' => 'nov',
                                'header' => 'พ.ย.',
                                'headerOptions' => ['width' => '100'],
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                                'pageSummary' => true,
                                'pageSummaryOptions' => ['class' => 'text-center'],
                            ],
                            [
                                'attribute' => 'dece',
                                'header' => 'ธ.ค.',
                                'headerOptions' => ['width' => '100'],
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                                'pageSummary' => true,
                                'pageSummaryOptions' => ['class' => 'text-center'],
                            ],
                            [
                                'attribute' => 'jan',
                                'header' => 'ม.ค.',
                                'headerOptions' => ['width' => '100'],
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                                'pageSummary' => true,
                                'pageSummaryOptions' => ['class' => 'text-center'],
                            ],
                            [
                                'attribute' => 'feb',
                                'header' => 'ก.พ.',
                                'headerOptions' => ['width' => '100'],
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                                'pageSummary' => true,
                                'pageSummaryOptions' => ['class' => 'text-center'],
                            ],
                            [
                                'attribute' => 'mar',
                                'header' => 'มี.ค',
                                'headerOptions' => ['width' => '100'],
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                                'pageSummary' => true,
                                'pageSummaryOptions' => ['class' => 'text-center'],
                            ],
                            [
                                'attribute' => 'apr',
                                'header' => 'เม.ย',
                                'headerOptions' => ['width' => '100'],
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                                'pageSummary' => true,
                                'pageSummaryOptions' => ['class' => 'text-center'],
                            ],
                            [
                                'attribute' => 'may',
                                'header' => 'พ.ค.',
                                'headerOptions' => ['width' => '100'],
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                                'pageSummary' => true,
                                'pageSummaryOptions' => ['class' => 'text-center'],
                            ],
                            [
                                'attribute' => 'june',
                                'header' => 'มิ.ย.',
                                'headerOptions' => ['width' => '100'],
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                                'pageSummary' => true,
                                'pageSummaryOptions' => ['class' => 'text-center'],
                            ],
                            [
                                'attribute' => 'july',
                                'header' => 'ก.ค.',
                                'headerOptions' => ['width' => '100'],
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                                'pageSummary' => true,
                                'pageSummaryOptions' => ['class' => 'text-center'],
                            ],
                            [
                                'attribute' => 'aug',
                                'header' => 'ส.ค.',
                                'headerOptions' => ['width' => '100'],
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                                'pageSummary' => true,
                                'pageSummaryOptions' => ['class' => 'text-center'],
                            ],
                            [
                                'attribute' => 'sep',
                                'header' => 'ก.ย.',
                                'headerOptions' => ['width' => '100'],
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                                'pageSummary' => true,
                                'pageSummaryOptions' => ['class' => 'text-center'],
                            ],
                            [
                                'class' => 'kartik\grid\FormulaColumn',
                                'header' => 'รวม',
                                'headerOptions' => ['width' => '100'],
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                                'value' => function ($model, $key, $index, $widget) {
                            $p = compact('model', 'key', 'index');
                            return $widget->col(1, $p) + $widget->col(2, $p) + $widget->col(3, $p) + $widget->col(4, $p) +
                                    $widget->col(5, $p) + $widget->col(6, $p) + $widget->col(7, $p) + $widget->col(8, $p) +
                                    $widget->col(9, $p) + $widget->col(10, $p) + $widget->col(11, $p) + $widget->col(12, $p);
                        },
                                'mergeHeader' => true,
                                //'width' => '150px',
                                'hAlign' => 'center',
                                //'format' => ['decimal', 0],
                                'pageSummary' => true,
                            ],
                        ],
                    ]);
                    ?>

                    <br /><br />

                    <div class="col-md-12">
                        <div class="panel-body">
                            <div style="display: none">
                                <?php
                                echo Highcharts::widget([
                                    'scripts' => [
                                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                                        'modules/exporting', // adds Exporting button/menu to chart
                                    //'themes/grid', // applies global 'grid' theme to all charts
                                    //'highcharts-3d'
                                    //'modules/drilldown'
                                    ]
                                ]);
                                ?>
                            </div>
                            <div id="pie-donut">
                            </div>
                            <?php
                            $this->registerJs("$(function () {
                                	$('#pie-donut').highcharts({
                                		chart: {
                                			plotBackgroundColor: null,
                                			plotBorderWidth: null,
                                			plotShadow: false,
                                			type: 'pie'
                                		},
                                		title: {
                                			text: '$title'
                                		},
                                		tooltip: {
                                			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                		},
                                		plotOptions: {
                                			pie: {
                                				allowPointSelect: true,
                                				cursor: 'pointer',
                                				depth: 35,
                                				dataLabels: {
                                					enabled: true,
                                					format: '<b>{point.name}</b>: {point.percentage:.1f} %',    //  แสดง %
                                					style: {
                                						color:'black'                     
                                					},
                                					connectorColor: 'silver'
                                				},
                                				startAngle: -90,
                                				endAngle: 90,
                                				center: ['50%', '75%']
                                			}
                                		},
                                		series: [{
                                			type: 'pie',
                                			name: 'ร้อยละ',
                                			innerSize: '50%',
                                			data: [
                                			['ต้องทบทวน',   $total1],
                                			['ทบทวนแล้ว',   $total2],
                                			]
                                		}]
                                	});
                                });
                                ");
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

