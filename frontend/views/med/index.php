<?php

use miloschuman\highcharts\Highcharts;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\BaseHtml;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use kartik\grid\GridView;

$this->title = 'Med-Rm';

$date_m = date("Y-m");
$date_d = date("Y-m-d");
$date_my = date("m-Y");

$date_D = date('Y-m-1');
$date_M = date('Y-m-31');


$time = time();
?>

<center>
    <div class="med-index">
        <div class="body-content">

            <div class="col-lg-3">
                <div class="info-box">
                    <!--a href="?r=report/report"-->
                    <span class="info-box-icon bg-default-gradient"><?= Html::img('./../images/med1.jpg'); ?><!--i class="fa fa-file-text-o"></i--></span>
                    <div class="info-box-content">
                        <span class="info-box-text">ใบความเสี่ยงทั้งหมด</br></br></span>
                        <span class="info-box-number">
                            <u>
                                <?php
                                $command = Yii::$app->db->createCommand("SELECT COUNT(id) AS total FROM risk_med");
                                $target = $command->queryScalar();

                                echo $target;
                                ?>
                                ใบ
                            </u>

                        </span>
                    </div><!-- /.info-box-content -->
                    <!--/a-->
                </div>
            </div>

            <div class="col-lg-3">
                <div class="info-box">
                    <!--a href="?r=report/report3"-->
                    <span class="info-box-icon bg-default"><?= Html::img('./../images/med2.jpg'); ?><!--i class="fa fa-spinner fa-pulse"></i--></span>
                    <div class="info-box-content">
                        <span class="info-box-text">ทบทวนแล้ว</br></br></span>
                        <span class="info-box-number">
                            <u>
                                <?php
                                $command = Yii::$app->db->createCommand("SELECT COUNT(id) AS total FROM risk_med WHERE status_id = '2'");
                                $target = $command->queryScalar();

                                echo $target;
                                ?>
                                ใบ
                            </u>

                        </span>
                    </div><!-- /.info-box-content -->
                    <!--/a-->
                </div>
            </div>

            <div class="col-lg-3">
                <div class="info-box">
                    <!--a href="?r=report/report5"-->
                    <span class="info-box-icon bg-defaul-gradient"><?= Html::img('./../images/med3.jpg'); ?><!--i class="fa fa-calendar"></i--></span>
                    <div class="info-box-content">
                        <span class="info-box-text">ประจำเดือน (<?php echo Yii::$app->formatter->asDateTime(time(), 'php:F'); ?>)</br></br><!--?php echo $date_my; ?--></span>
                        <span class="info-box-number">
                            <u>
                                <?php
                                //$command = Yii::$app->db->createCommand("SELECT count(id) as total FROM risk WHERE risk_date BETWEEN  '$date_D' and  '$date_M'");
                                $command = Yii::$app->db->createCommand("SELECT COUNT(id) AS total FROM risk_med WHERE risk_date BETWEEN '$date_D' and  '$date_M' ");
                                $target = $command->queryScalar();

                                echo $target;
                                ?>
                                ใบ
                            </u>

                        </span>
                    </div><!-- /.info-box-content -->
                    <!--/a-->
                </div>
            </div>


            <div class="col-lg-3">
                <div class="info-box">
                    <!--a href="?r=report/report4"-->
                    <span class="info-box-icon bg-default"><?= Html::img('./../images/med4.jpg'); ?><!--i class="fa fa-ambulance"></i--></span>
                    <div class="info-box-content">
                        <span class="info-box-text">พิการถาวร,เสียชีวิต </br></br></span>
                        <span class="info-box-number">
                            <u>
                                <?php
                                $command = Yii::$app->db->createCommand("SELECT COUNT(id) AS total FROM risk_med WHERE level_id IN ('7','8','9')");
                                $target = $command->queryScalar();

                                echo $target;
                                ?>
                                ใบ
                            </u>

                        </span>
                    </div><!-- /.info-box-content -->
                    <!--/a-->
                </div>
            </div>



            <!-- drilldown chart -->
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
                                            text: '10 อันดับหน่วยงานต้นเหตุ (ระบบยาและสารน้ำ)'
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
                                        drilldown: {
                                            series:$sub

                                        }
                                    });
                                });");
                    ?>   
                </div>
            </div>
            <!-- end drilldown chart -->


            <!-- pie chart -->
            <div class="panel-body">
                <div class="col-md-6">
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
                    $title = "ประเภทความเสี่ยง (ระบบยาและสารน้ำ)";
                    $type1 = Yii::$app->db->createCommand("SELECT COUNT(rd.type_med_id) as total from risk_med rd where rd.type_med_id ='1'")->queryScalar();
                    $type2 = Yii::$app->db->createCommand("SELECT COUNT(rd.type_med_id) as total from risk_med rd where rd.type_med_id ='2'")->queryScalar();
                    $type3 = Yii::$app->db->createCommand("SELECT COUNT(rd.type_med_id) as total from risk_med rd where rd.type_med_id ='3'")->queryScalar();
                    $type4 = Yii::$app->db->createCommand("SELECT COUNT(rd.type_med_id) as total from risk_med rd where rd.type_med_id ='4'")->queryScalar();
                    $this->registerJs("$(function () {
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
                                            ['Administration Error',   $type1],
                                            ['Dispensing Error',   $type2],
                                            ['Prescribing Error',   $type3],
                                            ['Processing Error',   $type4],
                                            ]
                                        }]
                                    });
                                });
                                ");
                    ?>

                </div>
                <!-- end pie chart -->





                <!-- colum chart -->
                <div class="col-md-6">
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
                    <div id="colum">
                    </div>

                    <?php
                    $this->registerJs("$(function () {     
                                    $('#colum').highcharts({
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
                                            text: 'ระดับ (ระบบยาและสารน้ำ)'
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
                                            data:$main_level
                                        }
                                        ],
                                    });
                                });");
                    ?>   
                </div>
            </div>
            <!-- end colum chart -->


            <!-- donut chart -->
            <div class="panel-body">
                <div class="col-md-6">
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
                    $title = "การทบทวน (ระบบยาและสารน้ำ)";
                    $type11 = Yii::$app->db->createCommand("SELECT SUM(total) as total
                                                            FROM (
                                                            SELECT count(rd.status_id) AS total FROM risk_med rd WHERE rd.status_id ='1'
                                                            ) AS tb")->queryScalar();
                    $type12 = Yii::$app->db->createCommand("SELECT SUM(total) as total
                                                            FROM (
                                                            SELECT count(rd.status_id) AS total FROM risk_med rd WHERE rd.status_id ='2'
                                                            ) AS tb")->queryScalar();

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
                <!-- end donut -->




                <!-- bar chart -->
                <div class="col-md-6">
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
                    $sql1 = "SELECT person,SUM(total) AS total
                                FROM (
                                SELECT p.person_type as person,count(rd.person_id) as total from risk_med rd
                                left outer join person p on p.id = rd.person_id 
                                group by person 
                                ) AS tb
                                GROUP BY person
                                ORDER BY total DESC";
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
                                            text: 'เกิดกับ ? (ระบบยาและสารน้ำ)'
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
            </div>
            <!-- end bar chart -->


            <!-- donut chart -->
            <div class="panel-body">
                <div class="col-md-12">
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
                    $title = "ระดับ (ระบบยาและสารน้ำ)";
                    $level1 = Yii::$app->db->createCommand("SELECT SUM(A) AS A
                                                                FROM (
                                                                SELECT count(rd.level_id) as A FROM risk_med rd WHERE rd.level_id ='1'
                                                                ) AS tb")->queryScalar();
                    $level2 = Yii::$app->db->createCommand("SELECT SUM(A) AS A
                                                                FROM (
                                                                SELECT count(rd.level_id) as A FROM risk_med rd WHERE rd.level_id ='2'
                                                                ) AS tb")->queryScalar();
                    $level3 = Yii::$app->db->createCommand("SELECT SUM(A) AS A
                                                                FROM (
                                                                SELECT count(rd.level_id) as A FROM risk_med rd WHERE rd.level_id ='3'
                                                                ) AS tb")->queryScalar();
                    $level4 = Yii::$app->db->createCommand("SELECT SUM(A) AS A
                                                                FROM (
                                                                SELECT count(rd.level_id) as A FROM risk_med rd WHERE rd.level_id ='4'
                                                                ) AS tb")->queryScalar();
                    $level5 = Yii::$app->db->createCommand("SELECT SUM(A) AS A
                                                                FROM (
                                                                SELECT count(rd.level_id) as A FROM risk_med rd WHERE rd.level_id ='5'
                                                                ) AS tb")->queryScalar();
                    $level6 = Yii::$app->db->createCommand("SELECT SUM(A) AS A
                                                                FROM (
                                                                SELECT count(rd.level_id) as A FROM risk_med rd WHERE rd.level_id ='6'
                                                                ) AS tb")->queryScalar();
                    $level7 = Yii::$app->db->createCommand("SELECT SUM(A) AS A
                                                                FROM (
                                                                SELECT count(rd.level_id) as A FROM risk_med rd WHERE rd.level_id ='7'
                                                                ) AS tb")->queryScalar();
                    $level8 = Yii::$app->db->createCommand("SELECT SUM(A) AS A
                                                                FROM (
                                                                SELECT count(rd.level_id) as A FROM risk_med rd WHERE rd.level_id ='8'
                                                                ) AS tb")->queryScalar();
                    $level9 = Yii::$app->db->createCommand("SELECT SUM(A) AS A
                                                                FROM (
                                                                SELECT count(rd.level_id) as A FROM risk_med rd WHERE rd.level_id ='9'
                                                                ) AS tb")->queryScalar();
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
    </div>
</center>

