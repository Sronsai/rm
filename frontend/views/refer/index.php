<?php

use miloschuman\highcharts\Highcharts;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\BaseHtml;
use yii\widgets\ActiveForm;
use frontend\assets\AppAsset;   // ใช้งาน AssetBundle
use yii\bootstrap\Tabs;
?>



<!--br /><br /><br /><br /><br /><br /><br /><br /-->
<div class="refer-index">
    <!--div class="jumbotron">
        <h1>Coming Soon!</h1><br />
    <!--?= Html::a('', [''], ['class' => 'fa fa-ambulance btn btn-danger btn-lg']); ?-->
    <!--?= Html::img('./../images/min.png'); ?-->

</div-->

<center>
    <div class="panel panel-default">

        <div class="row">
            <div class="panel-body">
                <div class="col-xs-12 col-md-3">        
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="success">
                                <td> <?= '<b>' . "จำนวนเคสที่ " . '&nbsp' . "ER" . '</b>' ?> :</td>
                                <td class="success">
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '2'");
                                    $target = $command->queryScalar();

                                    echo '<b>' . $target . '&nbsp' . "ครั้ง" . '</b>';
                                    ?>
                                </td>
                            </tr>
                            <tr class="danger">
                                <td>Trauma :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '2' AND typept_id = '1'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>
                            <tr class="danger">
                                <td>Non Trauma :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '2' AND typept_id = '2'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>

                        </tbody>
                    </table>

                    <table class="table table-bordered">
                        <tbody>
                            <tr class="danger">
                                <td>Resuscitation :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '2' AND strength_id = '01'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>
                            <tr class="warning">
                                <td>Emergency :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '2' AND strength_id = '02'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>
                            <tr class="warning">
                                <td>Urgency  :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '2' AND strength_id = '03'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>
                            <tr class="info">
                                <td>Semi-urgency  :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '2' AND strength_id = '04'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>   
                            <tr class="active">
                                <td>Non-urgency  :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '2' AND strength_id = '05'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr> 
                        </tbody>
                    </table>
                </div>


                <div class="col-xs-12 col-md-3">
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="success">
                                <td> <?= '<b>' . "จำนวนเคสที่ " . '&nbsp' . "OPD" . '</b>' ?> :</td>
                                <td class="success">
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '1'");
                                    $target = $command->queryScalar();

                                    echo '<b>' . $target . '&nbsp' . "ครั้ง" . '</b>';
                                    ?>
                                </td>
                            </tr>
                            <tr class="danger">
                                <td>Trauma :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '1' AND typept_id = '1'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>
                            <tr class="danger">
                                <td>Non Trauma :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '1' AND typept_id = '2'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>

                        </tbody>
                    </table>

                    <table class="table table-bordered">
                        <tbody>
                            <tr class="danger">
                                <td>Resuscitation :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '1' AND strength_id = '01'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>
                            <tr class="warning">
                                <td>Emergency :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '1' AND strength_id = '02'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>
                            <tr class="warning">
                                <td>Urgency  :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '1' AND strength_id = '03'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>
                            <tr class="info">
                                <td>Semi-urgency  :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '1' AND strength_id = '04'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>   
                            <tr class="active">
                                <td>Non-urgency  :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '1' AND strength_id = '05'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr> 
                        </tbody>
                    </table>
                </div>



                <div class="col-xs-12 col-md-3">    
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="success">
                                <td> <?= '<b>' . "จำนวนเคสที่ " . '&nbsp' . "IPD" . '</b>' ?> :</td>
                                <td class="success">
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '3'");
                                    $target = $command->queryScalar();

                                    echo '<b>' . $target . '&nbsp' . "ครั้ง" . '</b>';
                                    ?>
                                </td>
                            </tr>
                            <tr class="danger">
                                <td>Trauma :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '3' AND typept_id = '1'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>
                            <tr class="danger">
                                <td>Non Trauma :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '3' AND typept_id = '2'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>

                        </tbody>
                    </table>

                    <table class="table table-bordered">
                        <tbody>
                            <tr class="danger">
                                <td>Resuscitation :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '3' AND strength_id = '01'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>
                            <tr class="warning">
                                <td>Emergency :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '3' AND strength_id = '02'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>
                            <tr class="warning">
                                <td>Urgency  :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '3' AND strength_id = '03'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>
                            <tr class="info">
                                <td>Semi-urgency  :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '3' AND strength_id = '04'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>   
                            <tr class="active">
                                <td>Non-urgency  :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '3' AND strength_id = '05'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr> 
                        </tbody>
                    </table>
                </div>


                <div class="col-xs-12 col-md-3">     
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="success">
                                <td> <?= '<b>' . "จำนวนเคสที่ " . '&nbsp' . "LR" . '</b>' ?> :</td>
                                <td class="success">
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '4'");
                                    $target = $command->queryScalar();

                                    echo '<b>' . $target . '&nbsp' . "ครั้ง" . '</b>';
                                    ?>
                                </td>
                            </tr>
                            <tr class="danger">
                                <td>Trauma :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '4' AND typept_id = '1'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>
                            <tr class="danger">
                                <td>Non Trauma :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '4' AND typept_id = '2'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>

                        </tbody>
                    </table>

                    <table class="table table-bordered">
                        <tbody>
                            <tr class="danger">
                                <td>Resuscitation :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '4' AND strength_id = '01'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>
                            <tr class="warning">
                                <td>Emergency :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '4' AND strength_id = '02'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>
                            <tr class="warning">
                                <td>Urgency  :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '4' AND strength_id = '03'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>
                            <tr class="info">
                                <td>Semi-urgency  :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '4' AND strength_id = '04'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>   
                            <tr class="active">
                                <td>Non-urgency  :</td>
                                <td>
                                    <?php
                                    $command = Yii::$app->db_refer->createCommand("SELECT COUNT(station_id) FROM referout WHERE station_id = '4' AND strength_id = '05'");
                                    $target = $command->queryScalar();

                                    echo $target;
                                    ?>
                                    ราย
                                </td>
                            </tr>  
                        </tbody>
                    </table>
                </div>

            </div> <!-- body -->
        </div> <!-- row -->



        <!-- chart -->
        <div class="col-md-12">
            <div class="panel-body">
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
                                text: 'เหตุผลการส่งต่อ'
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

        <br />

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
                $title = "ระดับความรุนแรง";
                $type1 = Yii::$app->db_refer->createCommand("SELECT count(strength_id) as total FROM referout WHERE strength_id = '01'")->queryScalar();
                $type2 = Yii::$app->db_refer->createCommand("SELECT count(strength_id) as total FROM referout WHERE strength_id = '02'")->queryScalar();
                $type3 = Yii::$app->db_refer->createCommand("SELECT count(strength_id) as total FROM referout WHERE strength_id = '03'")->queryScalar();
                $type4 = Yii::$app->db_refer->createCommand("SELECT count(strength_id) as total FROM referout WHERE strength_id = '04'")->queryScalar();
                $type5 = Yii::$app->db_refer->createCommand("SELECT count(strength_id) as total FROM referout WHERE strength_id = '05'")->queryScalar();
                $type6 = Yii::$app->db_refer->createCommand("SELECT count(strength_id) as total FROM referout WHERE strength_id = '06'")->queryScalar();

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
                                ['Resuscitation',   $type1],
                                ['Emergency',   $type2],
                                ['Urgency',   $type3],
                                ['Semi-urgency',   $type4],
                                ['Non-urgency',   $type5],,
                            ]
                        }]
                    });
                });
                ");
                ?>

            </div>
            <!-- end pie chart -->



                <!-- donut chart -->
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
                    <div id="pie-donut11">
                    </div>
                    <?php
                    $title = "ประเภทผู้ป่วย";
                    $level1 = Yii::$app->db_refer->createCommand("SELECT count(typept_id) as total FROM referout WHERE typept_id ='1'")->queryScalar();
                    $level2 = Yii::$app->db_refer->createCommand("SELECT count(typept_id) as total FROM referout WHERE typept_id ='2'")->queryScalar();

                    $this->registerJs("$(function () {

                    $('#pie-donut11').highcharts({
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
                                    ['Trauma',   $level1],
                                    ['Non Trauma',   $level2],
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
</center>