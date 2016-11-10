<?php
/* @var $this yii\web\View */

//use fedemotta\datatables\DataTables;
use kartik\grid\GridView;
use frontend\models\Risk;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseHtml;
use yii\widgets\ActiveForm;
use frontend\assets\AppAsset;   // ใช้งาน AssetBundle
use yii\bootstrap\Tabs;

$this->title = 'รายงานความเสี่ยงภาพรวม CHART';

$this->params['breadcrumbs'][] = ['label' => 'รายงานความเสี่ยงภาพรวม', 'url' => ['/chart/index']];
$this->params['breadcrumbs'][] = 'รายงานความเสี่ยงภาพรวม CHART';
?>


<div class="report">
    <center><h1><u>รายงานความเสี่ยงภาพรวม CHART เลือกช่วงวัน</u></h1></center>



    <div class="well">

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
                                            text: '10 อันดับหน่วยงานต้นเหตุ'
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
            $title = "ประเภทความเสี่ยง";
            $type1 = Yii::$app->db->createCommand("SELECT COUNT(r.type_id) as total from risk r where r.type_id ='1' and risk_date BETWEEN '$date1' and '$date2'")->queryScalar();
            $type2 = Yii::$app->db->createCommand("SELECT COUNT(r.type_id) as total from risk r where r.type_id ='2' and risk_date BETWEEN '$date1' and '$date2'")->queryScalar();
            $type3 = Yii::$app->db->createCommand("SELECT COUNT(id) FROM risk_med WHERE risk_date BETWEEN '$date1' and '$date2'")->queryScalar();
            $type4 = Yii::$app->db->createCommand("SELECT COUNT(r.type_id) as total from risk r where r.type_id ='4' and risk_date BETWEEN '$date1' and '$date2'")->queryScalar();
            $type5 = Yii::$app->db->createCommand("SELECT COUNT(r.type_id) as total from risk r where r.type_id ='5' and risk_date BETWEEN '$date1' and '$date2'")->queryScalar();
            $type6 = Yii::$app->db->createCommand("SELECT COUNT(r.type_id) as total from risk r where r.type_id ='6' and risk_date BETWEEN '$date1' and '$date2'")->queryScalar();
            $type7 = Yii::$app->db->createCommand("SELECT COUNT(r.type_id) as total from risk r where r.type_id ='7' and risk_date BETWEEN '$date1' and '$date2'")->queryScalar();
            $type8 = Yii::$app->db->createCommand("SELECT COUNT(r.type_id) as total from risk r where r.type_id ='8' and risk_date BETWEEN '$date1' and '$date2'")->queryScalar();
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
                                            text: 'ระดับความรุนแรง'
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
            $title = "การทบทวนความเสี่ยง";
            $type11 = Yii::$app->db->createCommand("SELECT SUM(total) as total
                                                            FROM (
                                                            SELECT count(r.status_id) AS total FROM risk r WHERE r.status_id ='1' AND risk_date BETWEEN '$date1' and '$date2'
                                                            UNION ALL
                                                            SELECT count(rd.status_id) AS total FROM risk_med rd WHERE rd.status_id ='1'  AND risk_date BETWEEN '$date1' and '$date2'
                                                            ) AS tb")->queryScalar();
            $type12 = Yii::$app->db->createCommand("SELECT SUM(total) as total
                                                            FROM (
                                                            SELECT count(r.status_id) AS total FROM risk r WHERE r.status_id ='2' AND risk_date BETWEEN '$date1' and '$date2'
                                                            UNION ALL
                                                            SELECT count(rd.status_id) AS total FROM risk_med rd WHERE rd.status_id ='2' AND risk_date BETWEEN '$date1' and '$date2'
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
                                where risk_date between '$date1' and '$date2'
                                group by person 
                                UNION ALL
                                SELECT p.person_type as person,count(rd.person_id) as total from risk_med rd
                                left outer join person p on p.id = rd.person_id 
                                where risk_date between '$date1' and '$date2'
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
            //$title = "Clinic / Non Clinic (ตั้งแต่ ตุลาคม 2557)";
            $clinic = Yii::$app->db->createCommand("SELECT
(SELECT COUNT(r.type_clinic_id) FROM risk r WHERE r.type_clinic_id = '1' AND risk_date between '$date1' and '$date2')
+
(SELECT COUNT(rd.type_clinic_id) FROM risk_med rd WHERE rd.type_clinic_id = '1' AND risk_date between '$date1' and '$date2') as CLINIC")->queryScalar();
            $non_clinic = Yii::$app->db->createCommand("SELECT
(SELECT COUNT(type_clinic_id) FROM risk r WHERE r.type_clinic_id = '2' AND risk_date between '$date1' and '$date2')
+
(SELECT COUNT(rd.type_clinic_id) FROM risk_med rd WHERE rd.type_clinic_id = '2' AND risk_date between '$date1' and '$date2') as NON_CLINIC")->queryScalar();
            $this->registerJs("$(function () {

                                    $('#pie-donut2').highcharts({
                                        chart: {
                                            plotBackgroundColor: null,
                                            plotBorderWidth: null,
                                            plotShadow: false,
                                            type: 'pie'
                                        },
                                        title: {
                                            text: 'Clinic / Non Clinic'
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



</div>