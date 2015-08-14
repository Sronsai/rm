<?php
/* @var $this yii\web\View */

use fedemotta\datatables\DataTables;
use kartik\grid\GridView;
use miloschuman\highcharts\Highcharts;

$this->title = 'รายการความเสี่ยงงานคลินิกวัณโรค';
?>

<div class="report">
    <center>
        <div class="panel panel-default">
            <div class="panel-body">
                <h1><u>รายการความเสี่ยงทั้งหมด 
                        <?php
                        $command = Yii::$app->db->createCommand(" SELECT COUNT(location_riks_id) FROM risk WHERE location_riks_id = '24' ");
                        $target = $command->queryScalar();
                        echo $target;
                        ?>
                        รายการ
                    </u></h1>
            </div>
        </div>
    </center>

    <!-- Grid -->
    <div class="panel panel-default">
        <div class="panel-body">
            <?php
            echo DataTables::widget([
                'dataProvider' => $dataProvider,
                'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '0'],
                'columns' => [
                    [
                        'attribute' => 'hn',
                        'header' => 'HN'
                        ,
                        'headerOptions' => ['width' => '20']
                    ],
                    [
                        'attribute' => 'fullname',
                        'header' => 'ชื่อ-นามสกุล',
                        'headerOptions' => ['width' => '100']
                    ],
                    [
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
                      ], */
                    [
                        'attribute' => 'risk_summary',
                        'header' => 'รายละเอียดความเสี่ยง'
                    ],
                    [
                        'attribute' => 'type',
                        'header' => 'ประเภทความเสี่ยง',
                        'headerOptions' => ['width' => '120']
                    ],
                    [
                        'attribute' => 'level_e',
                        'header' => 'ระดับ',
                        'headerOptions' => ['width' => '20']
                    ],
                    [
                        'attribute' => 'status',
                        'header' => 'ทบทวน',
                        'headerOptions' => ['width' => '70']
                    ],
                ],
                'clientOptions' => [
                    "lengthMenu" => [[5, -1], [5, Yii::t('app', "All")]], //20 Rows
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
                ]
            ]);
            ?>
        </div>
    </div>
    <!-- END Grid -->


    <?php
    $script = <<< JS
$('#btn_sql').on('click', function(e) {
    
   $('#sql').toggle();
});
JS;
    $this->registerJs($script);
    ?>


    <!-- pie chart -->
    <div class="panel-body">
        <div class="col-md-7">
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
            <div id="pie">
            </div>
            <?php
            $title = "แยกตามประเภทความเสียง";
            $type1 = Yii::$app->db->createCommand("SELECT count(r.type_id) as total from risk r where r.location_riks_id = '24' and r.type_id ='1'")->queryScalar();
            $type2 = Yii::$app->db->createCommand("SELECT count(r.type_id) as total from risk r where r.location_riks_id = '24' and r.type_id ='2'")->queryScalar();
            $type3 = Yii::$app->db->createCommand("SELECT count(r.type_id) as total from risk r where r.location_riks_id = '24' and r.type_id ='3'")->queryScalar();
            $type4 = Yii::$app->db->createCommand("SELECT count(r.type_id) as total from risk r where r.location_riks_id = '24' and r.type_id ='4'")->queryScalar();
            $type5 = Yii::$app->db->createCommand("SELECT count(r.type_id) as total from risk r where r.location_riks_id = '24' and r.type_id ='5'")->queryScalar();
            $type6 = Yii::$app->db->createCommand("SELECT count(r.type_id) as total from risk r where r.location_riks_id = '24' and r.type_id ='6'")->queryScalar();
            $type7 = Yii::$app->db->createCommand("SELECT count(r.type_id) as total from risk r where r.location_riks_id = '24' and r.type_id ='7'")->queryScalar();
            $type8 = Yii::$app->db->createCommand("SELECT count(r.type_id) as total from risk r where r.location_riks_id = '24' and r.type_id ='8'")->queryScalar();
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
                        
                    $('#pie').highcharts({
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
                            data: [
                                ['การดูแลรักษา',   $type1],
                                ['ระบบเวชระเบียน',   $type2],
                                ['ระบบยา / สารน้ำ / เลือด',   $type3],
                                ['การคลอด',   $type4],
                                ['เครื่องมือ / อุปกรณ์การแพทย์',   $type5],
                                ['ระบบสาธาณูปโภค',   $type6],
                                ['ความปลอดภัย',   $type7],
                                ['อื่นๆ',   $type8],
                            ]
                        }]
                    });
                });
                ");
            ?>

        </div>
        <!-- end pie chart -->



        <!-- donut chart -->
        <div class="col-md-5">
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
            $title = "การทบทวน";
            $type11 = Yii::$app->db->createCommand("SELECT count(r.status_id) as total from risk r where r.location_riks_id = '24' and r.status_id ='1'")->queryScalar();
            $type12 = Yii::$app->db->createCommand("SELECT count(r.status_id) as total from risk r where r.location_riks_id = '24' and r.status_id ='2'")->queryScalar();

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
        </div>
    </div>
    <!-- end donut -->


    <!-- bar chart -->
    <div class="panel-body">
        <div class="col-md-7">
            <div style="display: none">
                <?php
                echo Highcharts::widget([
                    'scripts' => [
                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                        'modules/exporting', // adds Exporting button/menu to chart
                    //'themes/grid', // applies global 'grid' theme to all charts
                    //'highcharts-3d',
                    ]
                ]);
                ?>
            </div>
            <div id="bar-chart">
            </div>
            <?php
            $sql1 = "SELECT p.person_type as person,count(r.person_id) as total from risk r
                                left outer join person p on p.id = r.person_id
                                WHERE location_riks_id = '24' group by person order by total DESC";
            $rawData1 = Yii::$app->db->createCommand($sql1)->queryAll();
            $main_data1 = [];
            foreach ($rawData1 as $data1) {
                //echo $data1['strength_id'];
                $main_data1[] = [
                    'name' => $data1['person'],
                    'y' => $data1['total'] * 1,
                ];
            }
            $main1 = json_encode($main_data1);
            ?>
            <?php
            $this->registerJs("$(function () {
                        $('#bar-chart').highcharts({
                            chart: {
                            type: 'bar',
                            margin: 75,
                            options3d: {
                                enabled: true,
                                alpha: 10,
                                beta: 30,
                                depth: 70
                            }
                            },
                            title: {
                                text: 'เหตุการณ์เกิดกับ'
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
                                name: '.',
                                colorByPoint: true,
                                data:$main1

                            }
                            ],
                            
                        });
                    });");
            ?>
        </div>
        <!-- end bar chart -->


        <!-- donut chart -->
        <div class="col-md-5">
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
            <div id="pie-donut2">
            </div>
            <?php
            $title = "แยกตามระดับความรุนแรง";
            $level1 = Yii::$app->db->createCommand("SELECT count(r.level_id) as A from risk r where r.location_riks_id = '24' and r.level_id ='1'")->queryScalar();
            $level2 = Yii::$app->db->createCommand("SELECT count(r.level_id) as A from risk r where r.location_riks_id = '24' and r.level_id ='2'")->queryScalar();
            $level3 = Yii::$app->db->createCommand("SELECT count(r.level_id) as A from risk r where r.location_riks_id = '24' and r.level_id ='3'")->queryScalar();
            $level4 = Yii::$app->db->createCommand("SELECT count(r.level_id) as A from risk r where r.location_riks_id = '24' and r.level_id ='4'")->queryScalar();
            $level5 = Yii::$app->db->createCommand("SELECT count(r.level_id) as A from risk r where r.location_riks_id = '24' and r.level_id ='5'")->queryScalar();
            $level6 = Yii::$app->db->createCommand("SELECT count(r.level_id) as A from risk r where r.location_riks_id = '24' and r.level_id ='6'")->queryScalar();
            $level7 = Yii::$app->db->createCommand("SELECT count(r.level_id) as A from risk r where r.location_riks_id = '24' and r.level_id ='7'")->queryScalar();
            $level8 = Yii::$app->db->createCommand("SELECT count(r.level_id) as A from risk r where r.location_riks_id = '24' and r.level_id ='8'")->queryScalar();
            $level9 = Yii::$app->db->createCommand("SELECT count(r.level_id) as A from risk r where r.location_riks_id = '24' and r.level_id ='9'")->queryScalar();
            $this->registerJs("$(function () {

                    $('#pie-donut2').highcharts({
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
                                    //format: '<b>{point.name}</b>: {point.percentage:.1f} %',    //  แสดง %
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
                        /*plotOptions: {
                            pie: {
                                    dataLabels: {
                                        allowPointSelect: true,
                                        cursor: 'pointer',
                                        depth: 35,
                                        style: {
                                        color:'black',                 
                                                },
                                            connectorColor: 'silver'
                                            },
                                        startAngle: -90,
                                        endAngle: 90,
                                        center: ['50%', '75%']
                                    }
                            },*/
                            legend: {
                                enabled: true
                            },
                        series: [{
                            type: 'pie',
                            name: 'ร้อยละ',
                             innerSize: '50%',
                            data: [
                                    ['A',   $level1],
                                    ['B',   $level2],
                                    ['C',   $level3],
                                    ['D',   $level4],
                                    ['E',   $level5],
                                    ['F',   $level6],
                                    ['G',   $level7],
                                    ['H',   $level8],
                                    ['I',   $level9],
                            ]
                        }]
                    });
                });
                ");
            ?>
        </div>
    </div>
    <!-- end donut -->

</div>