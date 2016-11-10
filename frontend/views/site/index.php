<?php

use miloschuman\highcharts\Highcharts;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\BaseHtml;
use yii\widgets\ActiveForm;
use frontend\assets\AppAsset;   // ใช้งาน AssetBundle
use yii\bootstrap\Tabs;

AppAsset::register($this);   // ใช้งาน AssetBundle

$this->title = 'Rm';

$date_m = date("Y-m");
$date_d = date("Y-m-d");
$date_my = date("m-Y");

$date_D = date('Y-m-1');
$date_M = date('Y-m-31');


$time = time();
?>


<!-- Popup แสดงการบันทึกความเสี่ยงส่งมาจาก Controller  -->
<?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
    <?php
    echo \kartik\widgets\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'info',
        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'บันทึกข้อมูลเรียบร้อย',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'ขอบคุณมากค่ะ',
        'showSeparator' => true,
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);
    ?>
<?php endforeach; ?>


<center>
    <div class="site-index">
        <div class="body-content">

            <div class="col-lg-3">
                <div class="info-box">
                    <a href="?r=report/report">
                        <span class="info-box-icon bg-blue-gradient"><i class="fa fa-file-text-o"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">ใบความเสี่ยงทั้งหมด</br></br></span>
                            <span class="info-box-number">
                                <u>
                                    <?php
                                    $command = Yii::$app->db->createCommand("SELECT SUM(
                                                                                    (SELECT count(id) as total FROM risk)
                                                                                    +
                                                                                    (SELECT count(id) as total FROM risk_med)
                                                                                    )
                                                                                    AS tb");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ใบ
                                </u>

                            </span>
                        </div><!-- /.info-box-content -->
                    </a>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="info-box">
                    <a href="?r=report/report3">
                        <span class="info-box-icon bg-green"><i class="fa fa-spinner fa-pulse"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">ทบทวนแล้ว</br></br></span>
                            <span class="info-box-number">
                                <u>
                                    <?php
                                    $command = Yii::$app->db->createCommand("SELECT SUM(
                                                                                    (SELECT count(id) as total FROM risk WHERE status_id ='2')
                                                                                    +
                                                                                    (SELECT count(id) as total FROM risk_med WHERE status_id ='2')
                                                                                    )
                                                                                    AS tb");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ใบ
                                </u>

                            </span>
                        </div><!-- /.info-box-content -->
                    </a>
                </div>
            </div>


            <div class="col-lg-3">
                <div class="info-box">
                    <a href="?r=report/report5">
                        <span class="info-box-icon bg-yellow-gradient"><i class="fa fa-calendar"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">ประจำเดือน (<?php echo Yii::$app->formatter->asDateTime(time(), 'php:F'); ?>)</br></br><!--?php echo $date_my; ?--></span>
                            <span class="info-box-number">
                                <u>
                                    <?php
                                    //$command = Yii::$app->db->createCommand("SELECT count(id) as total FROM risk WHERE risk_date BETWEEN  '$date_D' and  '$date_M'");
                                    $command = Yii::$app->db->createCommand("SELECT SUM(
                                                                                    (SELECT count(id) as total FROM risk 
                                                                                    WHERE risk_date BETWEEN  '$date_D' and  '$date_M')
                                                                                    +
                                                                                    (SELECT count(id) as total FROM risk_med
                                                                                    WHERE risk_date BETWEEN  '$date_D' and  '$date_M')
                                                                                    )
                                                                                    AS tb");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ใบ
                                </u>

                            </span>
                        </div><!-- /.info-box-content -->
                    </a>
                </div>
            </div>


            <div class="col-lg-3">
                <div class="info-box">
                    <a href="?r=report/report4">
                        <span class="info-box-icon bg-red"><i class="fa fa-ambulance"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">พิการถาวร,เสียชีวิต </br></br></span>
                            <span class="info-box-number">
                                <u>
                                    <?php
                                    $command = Yii::$app->db->createCommand("SELECT SUM(
                                                                                (SELECT count(level_id) as total FROM risk WHERE level_id in ('7','8','9'))
                                                                                +
                                                                                (SELECT count(level_id) as total FROM risk_med WHERE level_id in ('7','8','9'))
                                                                                )
                                                                                AS tb");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ใบ
                                </u>

                            </span>
                        </div><!-- /.info-box-content -->
                    </a>
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
                                            text: '10 อันดับหน่วยงานต้นเหตุ (ตั้งแต่ ตุลาคม 2557)'
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
                    $title = "ประเภท (ตั้งแต่ ตุลาคม 2557)";
                    $type1 = Yii::$app->db->createCommand("SELECT COUNT(r.type_id) as total from risk r where r.type_id ='1'")->queryScalar();
                    $type2 = Yii::$app->db->createCommand("SELECT COUNT(r.type_id) as total from risk r where r.type_id ='2'")->queryScalar();
                    $type3 = Yii::$app->db->createCommand("SELECT COUNT(id) FROM risk_med")->queryScalar();
                    $type4 = Yii::$app->db->createCommand("SELECT COUNT(r.type_id) as total from risk r where r.type_id ='4'")->queryScalar();
                    $type5 = Yii::$app->db->createCommand("SELECT COUNT(r.type_id) as total from risk r where r.type_id ='5'")->queryScalar();
                    $type6 = Yii::$app->db->createCommand("SELECT COUNT(r.type_id) as total from risk r where r.type_id ='6'")->queryScalar();
                    $type7 = Yii::$app->db->createCommand("SELECT COUNT(r.type_id) as total from risk r where r.type_id ='7'")->queryScalar();
                    $type8 = Yii::$app->db->createCommand("SELECT COUNT(r.type_id) as total from risk r where r.type_id ='8'")->queryScalar();
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
                                            ['การดูแลรักษา',   $type1],
                                            ['ระบบเวชระเบียน',   $type2],
                                            ['ระบบยา/สารน้ำ/เลือด',   $type3],
                                            ['การคลอด',   $type4],
                                            ['เครื่องมือ/อุปกรณ์การแพทย์',   $type5],
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
                                            text: 'ระดับ (ตั้งแต่ ตุลาคม 2557)'
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
                    $title = "การทบทวน (ตั้งแต่ ตุลาคม 2557)";
                    $type11 = Yii::$app->db->createCommand("SELECT SUM(total) as total
                                                            FROM (
                                                            SELECT count(r.status_id) AS total FROM risk r WHERE r.status_id ='1'
                                                            UNION ALL
                                                            SELECT count(rd.status_id) AS total FROM risk_med rd WHERE rd.status_id ='1'
                                                            ) AS tb")->queryScalar();
                    $type12 = Yii::$app->db->createCommand("SELECT SUM(total) as total
                                                            FROM (
                                                            SELECT count(r.status_id) AS total FROM risk r WHERE r.status_id ='2'
                                                            UNION ALL
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
                                SELECT p.person_type as person,count(r.person_id) as total from risk r
                                left outer join person p on p.id = r.person_id 
                                group by person 
                                UNION ALL
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
                                            text: 'เกิดกับ ? (ตั้งแต่ ตุลาคม 2557)'
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
                    
                    $title = "Clinic / Non Clinic (ตั้งแต่ ตุลาคม 2557)";
                    $clinic = Yii::$app->db->createCommand("SELECT
(SELECT COUNT(r.type_clinic_id) FROM risk r WHERE r.type_clinic_id = '1')
+
(SELECT COUNT(rd.type_clinic_id) FROM risk_med rd WHERE rd.type_clinic_id = '1') as CLINIC")->queryScalar();
                    $non_clinic = Yii::$app->db->createCommand("SELECT
(SELECT COUNT(type_clinic_id) FROM risk r WHERE r.type_clinic_id = '2')
+
(SELECT COUNT(rd.type_clinic_id) FROM risk_med rd WHERE rd.type_clinic_id = '2') as NON_CLINIC")->queryScalar();
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
                                        colors: ['#FF0000', '#000000'],
                                        series: [{
                                            type: 'pie',
                                            name: 'ร้อยละ',
                                            innerSize: '50%',
                                            data: [
                                            ['CLINIC',   $clinic],
                                            ['NON CLINIC',   $non_clinic],
                                            ]
                                        }]
                                    });
                                });
                                ");
                    ?>
                </div>
            </div>
            <!-- end donut -->

        </div><!-- ./div row -->
    </div>
</center>
