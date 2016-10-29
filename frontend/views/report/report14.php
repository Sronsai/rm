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

$this->title = 'กราฟแสดงระดับอุบัติการณ์ตามไตรมาส ปีงบประมาณ 2559';

$this->params['breadcrumbs'][] = ['label' => 'กราฟแสดงระดับอุบัติการณ์ตามไตรมาส ปีงบประมาณ 2559', 'url' => ['/report/report14']];
$this->params['breadcrumbs'][] = 'กราฟแสดงระดับอุบัติการณ์ตามไตรมาส ปีงบประมาณ 2559';
?>


<div class="report">
    <center><h1><u>กราฟแสดงระดับอุบัติการณ์ตามไตรมาส ปีงบประมาณ 2559 </u></h1></center>


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
    $('#chart1').highcharts({
        title: {
            text: 'กราฟแสดงระดับอุบัติการณ์ตามไตรมาส ปีงบประมาณ 2559',
            x: -20 //center
        },
        subtitle: {
            text: 'ปีงบประมาณ 2559',
            x: -20
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'ปีงบประมาณ 2559'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        tooltip: {
            valueSuffix: ' ครั้ง'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
             name: 'A = NEAR MISS',
             data: $main1
        },
        {
             name: 'BC = LOW',
             data: $main2
        },
        {
             name: 'DEF = MODERRATE',
             data: $main3
        },
        {
             name: 'GHI = HIGH',
             data: $main4
        }]
    });
});");
            ?>   
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-body">
            <?php
            if (isset($dataProvider))
                $dev = \yii\helpers\Html::a('คุณดนัย สอนไสย', 'https://fb.com/foyplvowlp', ['target' => '_blank']);


//echo yii\grid\GridView::widget([
            echo \kartik\grid\GridView::widget([
                //echo DataTables::widget([
                'dataProvider' => $dataProvider,
                'panel' => [
                    'before' => ''
                ],
                'export' => [
                    'showConfirmAlert' => false,
                    'target' => GridView::TARGET_BLANK
                ],
                //'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '0'],
                //'dataProvider' => $dataProvider,
                //'responsive' => TRUE,
                //'hover' => true,
                //'floatHeader' => true,
                //'panel' => [
                //'type' => \kartik\grid\GridView::TYPE_SUCCESS,
                //'after' => 'โดย ' . $dev
                //],
                'columns' => [
                    [
                        'attribute' => 'name',
                        'header' => 'ระดับการเกิดอุบัติการณ์',
                        'headerOptions' => ['width' => '200'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                    [
                        'attribute' => 'TM1',
                        'header' => 'ไตรมาส ที่ 1',
                        'headerOptions' => ['width' => '100'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                    [
                        'attribute' => 'TM2',
                        'header' => 'ไตรมาส ที่ 2',
                        'headerOptions' => ['width' => '100'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                    [
                        'attribute' => 'TM3',
                        'header' => 'ไตรมาส ที่ 3 ',
                        'headerOptions' => ['width' => '100'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                    [
                        'attribute' => 'TM4',
                        'header' => 'ไตรมาส ที่ 4',
                        'headerOptions' => ['width' => '100'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                ]
            ]);
            ?>
        </div>
    </div>


</div>