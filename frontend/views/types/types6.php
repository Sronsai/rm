<?php
/* @var $this yii\web\View */

//use fedemotta\datatables\DataTables;
use kartik\grid\GridView;
use miloschuman\highcharts\Highcharts;

$this->title = 'รายการความเสี่ยงแยกตามประเภทระบบสาธารณูปโภค';

$this->params['breadcrumbs'][] = ['label' => 'รายการความเสี่ยงทั้งหมด', 'url' => ['/report/report']];
$this->params['breadcrumbs'][] = 'รายการความเสี่ยงแยกตามประเภทระบบสาธารณูปโภค';
?>



<div class="safe">
    <center><h1>รายการความเสี่ยงแยกตามประเภทระบบสาธารณูปโภค</h1></center>



    <div class="row">       
        <div class="col-md-12">
            <div class="col-md-6">


                <?php
                if (isset($dataProvider3))
                    $dev = \yii\helpers\Html::a('คุณดนัย สอนไสย', 'https://fb.com/foyplvowlp', ['target' => '_blank']);


//echo yii\grid\GridView::widget([
//echo \kartik\grid\GridView::widget([
                echo GridView::widget([
                    'dataProvider' => $dataProvider3,
                    //'filterModel' => $searchModel,
                    'responsive' => true,
                    'hover' => true,
                    'floatHeader' => false,
                    'panel' => [
                        //'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> RM</h3>',
                        //'type' => 'info',
                        'before' => '<CENTER><H4><U>ประเภทความเสี่ยงที่เกิดซ้ำ (ตั้งแต่ ต.ค 57)</U></H4></CENTER>',
                    //'after' => '',
                    //'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
                    //'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
                    //'footer' => false
                    ],
                    'columns' => [
                        [
                            'attribute' => 'location_name',
                            'header' => 'หน่วยงานต้นเหตุ',
                            'headerOptions' => ['width' => '50'],
                        //'location' => ['location' => SORT_DESC],
                        ],
                        [
                            'attribute' => 'type_name',
                            'header' => 'ประเภท',
                            'headerOptions' => ['width' => '30']
                        ],
                        [
                            'attribute' => 'sub_type_name',
                            'header' => 'ประเภทย่อย',
                            'headerOptions' => ['width' => '50'],
                        //'location' => ['location' => SORT_DESC],
                        ],
                        [
                            'attribute' => 'total',
                            'header' => 'จำนวน',
                            'headerOptions' => ['width' => '30']
                        ],
                    ]
                ]);
                ?>


                <?php
                if (isset($dataProvider))
                    $dev = \yii\helpers\Html::a('คุณดนัย สอนไสย', 'https://fb.com/foyplvowlp', ['target' => '_blank']);

                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'responsive' => true,
                    'hover' => true,
                    'floatHeader' => false,
                    'panel' => [
                        //'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> RM</h3>',
                        //'type' => 'info',
                        'before' => '<CENTER><H4><U>ระดับความรุนแรง ตั้งแต่ ต.ค 57</U></H4></CENTER>',
                    //'after' => '',
                    //'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
                    //'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
                    //'footer' => false
                    ],
                    'columns' => [
                        [
                            'attribute' => 'location',
                            'header' => 'หน่วยงานต้นเหตุ',
                            'headerOptions' => ['width' => '50'],
                        //'location' => ['location' => SORT_DESC],
                        ],
                        [
                            'attribute' => 'A',
                            'header' => 'A',
                            'headerOptions' => ['width' => '30']
                        ],
                        [
                            'attribute' => 'B',
                            'header' => 'B',
                            'headerOptions' => ['width' => '30']
                        ],
                        [
                            'attribute' => 'C',
                            'header' => 'C',
                            'headerOptions' => ['width' => '30']
                        ],
                        [
                            'attribute' => 'D',
                            'header' => 'D',
                            'headerOptions' => ['width' => '30']
                        ],
                        [
                            'attribute' => 'E',
                            'header' => 'E',
                            'headerOptions' => ['width' => '30']
                        ],
                        [
                            'attribute' => 'F',
                            'header' => 'F',
                            'headerOptions' => ['width' => '30']
                        ],
                        [
                            'attribute' => 'G',
                            'header' => 'G',
                            'headerOptions' => ['width' => '30']
                        ],
                        [
                            'attribute' => 'H',
                            'header' => 'H',
                            'headerOptions' => ['width' => '30']
                        ],
                        [
                            'attribute' => 'I',
                            'header' => 'I',
                            'headerOptions' => ['width' => '30']
                        ],
                        [
                            'attribute' => 'TOTAL',
                            'header' => 'รวม',
                            'headerOptions' => ['width' => '30']
                        ],
                    ],
                ]);
                ?>


            </div>
            <div class="col-md-6">

                <?php
                if (isset($dataProvider1))
                    $dev = \yii\helpers\Html::a('คุณดนัย สอนไสย', 'https://fb.com/foyplvowlp', ['target' => '_blank']);


//echo yii\grid\GridView::widget([
//echo \kartik\grid\GridView::widget([
                echo GridView::widget([
                    'dataProvider' => $dataProvider1,
                    //'filterModel' => $searchModel,
                    'responsive' => true,
                    'hover' => true,
                    'floatHeader' => false,
                    'panel' => [
                        //'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> RM</h3>',
                        //'type' => 'info',
                        'before' => '<CENTER><H4><U>การทบทวน ตั้งแต่ ต.ค 57</U></H4></CENTER>',
                    //'after' => '',
                    //'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
                    //'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
                    //'footer' => false
                    ],
                    'columns' => [
                        [
                            'attribute' => 'status_name',
                            'header' => 'สถานะ',
                            'headerOptions' => ['width' => '50'],
                        //'location' => ['location' => SORT_DESC],
                        ],
                        [
                            'attribute' => 'status_id',
                            'header' => 'จำนวน',
                            'headerOptions' => ['width' => '30']
                        ],
                    ]
                ]);
                ?>




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
                $title = "การทบทวน ตั้งแต่ ต.ค 57";
                $type11 = Yii::$app->db->createCommand("SELECT count(r.status_id) as total from risk r where r.status_id ='1' and type_id = '6'")->queryScalar();
                $type12 = Yii::$app->db->createCommand("SELECT count(r.status_id) as total from risk r where r.status_id ='2' and type_id = '6'")->queryScalar();

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
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color:'black'                     
                                    },
                                    connectorColor: 'silver'
                                }
                            }
                        },
                        series: [{
                            type: 'pie',
                            name: 'ร้อยละ',
                             innerSize: '50%',
                            data: [
                                ['ต้องทบทวน',   $type11],
                                ['ทบทวนแล้ว',   $type12],
                            ]
                        }]
                    });
                });
                ");
                ?>
                <br />
                <div style="display: none">
                    <?php
                    echo Highcharts::widget([
                        'scripts' => [
                            'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                            'modules/exporting', // adds Exporting button/menu to chart
                            //'themes/grid', // applies global 'grid' theme to all charts
                            //'highcharts-3d',
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
                                text: 'แยกตามหน่วยงาน ตั้งแต่ ต.ค 57'
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
                    });"
                );
                ?>   

            </div>
        </div>


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