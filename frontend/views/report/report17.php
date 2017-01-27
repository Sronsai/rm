<?php
/* @var $this yii\web\View */

use fedemotta\datatables\DataTables;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use miloschuman\highcharts\Highcharts;

$this->title = 'กราฟ 5 อันดับ แต่ละประเภท';

//use yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => 'กราฟ 5 อันดับ แต่ละประเภท', 'url' => ['/report/report17']];
$this->params['breadcrumbs'][] = 'กราฟ 5 อันดับ แต่ละประเภท';
?>

<div class="report">
    <center><h1><u>กราฟ 5 อันดับ แต่ละประเภท</u></h1></center>


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
</div>





<div class="col-md-12">
    <div class="row">
        <!-- chart -->
        <div class="col-md-6">
            <div class="panel-body">
                <div style="display: none">
                    <?php
                    echo Highcharts::widget([
                        'scripts' => [
                            'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                            'modules/exporting', // adds Exporting button/menu to chart
                        //'themes/grid', // applies global 'grid' theme to all charts
                        //'highcharts-3d',
                        //'modules/drilldown'
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
                                            text: 'การดูแลรักษา'
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

        <!-- colum chart -->
        <div class="col-md-6">
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
                                            text: 'ระบบเวชระเบียน'
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
                                            data:$main2
                                        }
                                        ],
                                    });
                                });");
                ?>   
            </div>
        </div>

        <!-- end colum chart -->
    </div>
</div>






<div class="col-md-12">
    <div class="row">

        <!-- colum chart -->
        <div class="col-md-6">
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
                <div id="colum3">
                </div>

                <?php
                $this->registerJs("$(function () {     
                                    $('#colum3').highcharts({
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
                                            text: 'ระบบควบคุมการติดเชื้อ (IC)'
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
                                            data:$main3
                                        }
                                        ],
                                    });
                                });");
                ?>   
            </div>
        </div>



        <!-- colum chart -->
        <div class="col-md-6">
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
                <div id="colum4">
                </div>

                <?php
                $this->registerJs("$(function () {     
                                    $('#colum4').highcharts({
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
                                            text: 'การคลอด '
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
                                            data:$main4
                                        }
                                        ],
                                    });
                                });");
                ?>   
            </div>
        </div>




        <div class="col-md-12">
            <div class="row">

                <!-- colum chart -->
                <div class="col-md-6">
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
                        <div id="colum5">
                        </div>

                        <?php
                        $this->registerJs("$(function () {     
                                    $('#colum5').highcharts({
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
                                            text: 'เครื่องมือ / อุปกรณ์การแพทย์'
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
                                            data:$main5
                                        }
                                        ],
                                    });
                                });");
                        ?>   
                    </div>
                </div>

                <!-- colum chart -->
                <div class="col-md-6">
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
                        <div id="colum6">
                        </div>

                        <?php
                        $this->registerJs("$(function () {     
                                    $('#colum6').highcharts({
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
                                            text: 'ระบบสาธารณูปโภค / สิ่งแวดล้อม'
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
                                            data:$main6
                                        }
                                        ],
                                    });
                                });");
                        ?>   
                    </div>
                </div>




                <div class="col-md-12">
                    <div class="row">

                        <!-- colum chart -->
                        <div class="col-md-6">
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
                                <div id="colum7">
                                </div>

                                <?php
                                $this->registerJs("$(function () {     
                                    $('#colum7').highcharts({
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
                                            text: 'ความปลอดภัย'
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
                                            data:$main7
                                        }
                                        ],
                                    });
                                });");
                                ?>   
                            </div>
                        </div>

                        <!-- colum chart -->
                        <div class="col-md-6">
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
                                <div id="colum8">
                                </div>

                                <?php
                                $this->registerJs("$(function () {     
                                    $('#colum8').highcharts({
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
                                            text: 'ระบบเอ๊กซเรย์ (XRAY)'
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
                                            data:$main8
                                        }
                                        ],
                                    });
                                });");
                                ?>   
                            </div>
                        </div>

                    </div>
                </div>




                <div class="col-md-12">
                    <div class="row">

                        <!-- colum chart -->
                        <div class="col-md-6">
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
                                <div id="colum9">
                                </div>

                                <?php
                                $this->registerJs("$(function () {     
                                    $('#colum9').highcharts({
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
                                            text: 'ระบบ Lab (LAB)'
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
                                            data:$main9
                                        }
                                        ],
                                    });
                                });");
                                ?>   
                            </div>
                        </div>



                        <!-- colum chart -->
                        <div class="col-md-6">
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
                                <div id="colum10">
                                </div>

                                <?php
                                $this->registerJs("$(function () {     
                                    $('#colum10').highcharts({
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
                                            text: 'ระบบยา'
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
                                            data:$main10
                                        }
                                        ],
                                    });
                                });");
                                ?>   
                            </div>
                        </div>
                        
                        
                        
                        
                        <!-- colum chart -->
                        <div class="col-md-6">
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
                                <div id="colum11">
                                </div>

                                <?php
                                $this->registerJs("$(function () {     
                                    $('#colum11').highcharts({
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
                                            text: 'ระบบ Lab (LAB)'
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
                                            data:$main11
                                        }
                                        ],
                                    });
                                });");
                                ?>   
                            </div>
                        </div>
                        
                        
                        
                        
                        
                        <!-- colum chart -->
                        <div class="col-md-6">
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
                                <div id="colum12">
                                </div>

                                <?php
                                $this->registerJs("$(function () {     
                                    $('#colum12').highcharts({
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
                                            text: 'ระบบความเสี่ยงทั่วไป (บริหาร)'
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
                                            data:$main12
                                        }
                                        ],
                                    });
                                });");
                                ?>   
                            </div>
                        </div>
                        
                        
                        
                        
                         
                        <!-- colum chart -->
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
                                <div id="colum13">
                                </div>

                                <?php
                                $this->registerJs("$(function () {     
                                    $('#colum13').highcharts({
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
                                            text: 'เรื่องร้องเรียน / สิทธิ์ผู้ป่วย (HRD)'
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
                                            data:$main13
                                        }
                                        ],
                                    });
                                });");
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

