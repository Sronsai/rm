<?php

use miloschuman\highcharts\Highcharts;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
?>



<div style="display: none">
    <?php
    echo Highcharts::widget([
        'scripts' => [
            'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
        //'modules/exporting', // adds Exporting button/menu to chart
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
            text: '2015'
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
                ['Microsoft Internet Explorer', 50],
                ['Chrome', 20],
                ['Firefox', 10],
                ['Safari', 10], 
                ['Opera', 5],
                ['Proprietary or Undetectable', 5]
            ]
        }]
    });
});
");
?>



<div style="display: none">
    <?php
    echo Highcharts::widget([
        'scripts' => [
            'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
        //'modules/exporting', // adds Exporting button/menu to chart
        //'themes/grid', // applies global 'grid' theme to all charts
        //'highcharts-3d'
        //'modules/drilldown'
        ]
    ]);
    ?>
</div>
<div id="pie1">
</div>

<?php
$this->registerJs("$(function () {
    
$(function () {
    $('#pie1').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
        },
        title: {
            text: 'Browser<br>shares<br>2015',
            align: 'center',
            verticalAlign: 'middle',
            y: 40
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: true,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '75%']
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            innerSize: '50%',
            data: [
                ['Firefox',50],
                ['IE',20],
                ['Chrome',20],
                ['Safari',5],
                ['Opera',5],
            ]
        }]
    });
});
});
");
?>


