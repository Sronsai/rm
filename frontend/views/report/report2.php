<?php
/* @var $this yii\web\View */

use fedemotta\datatables\DataTables;
use kartik\grid\GridView;

$this->title = 'รายการความเสี่ยงแยกตามระดับความรุนแรง';

$this->params['breadcrumbs'][] = ['label' => 'รายการความเสี่ยงทั้งหมด', 'url' => ['/report/report']];
$this->params['breadcrumbs'][] = 'รายการความเสี่ยงแยกตามระดับความรุนแรง';
?>

<div class="report">
    <center><h1><u>รายการความเสี่ยง แยกตามระดับความรุนแรง</u></h1></center>

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
                        'attribute' => 'location',
                        'header' => 'สถานที่เกิดเหตุ',
                        'headerOptions' => ['width' => '200'],
                    //'location' => ['location' => SORT_DESC],
                    ],
                    [
                        'attribute' => 'A',
                        'header' => 'A',
                        'headerOptions' => ['width' => '10']
                    ],
                    [
                        'attribute' => 'B',
                        'header' => 'B',
                        'headerOptions' => ['width' => '10']
                    ],
                    [
                        'attribute' => 'C',
                        'header' => 'C',
                        'headerOptions' => ['width' => '10']
                    ],
                    [
                        'attribute' => 'D',
                        'header' => 'D',
                        'headerOptions' => ['width' => '10']
                    ],
                    [
                        'attribute' => 'E',
                        'header' => 'E',
                        'headerOptions' => ['width' => '10']
                    ],
                    [
                        'attribute' => 'F',
                        'header' => 'F',
                        'headerOptions' => ['width' => '10']
                    ],
                    [
                        'attribute' => 'G',
                        'header' => 'G',
                        'headerOptions' => ['width' => '10']
                    ],
                    [
                        'attribute' => 'H',
                        'header' => 'H',
                        'headerOptions' => ['width' => '10']
                    ],
                    [
                        'attribute' => 'I',
                        'header' => 'I',
                        'headerOptions' => ['width' => '10']
                    ],
                    [
                        'attribute' => 'TOTAL',
                        'header' => 'TOTAL',
                        'headerOptions' => ['width' => '10']
                    ],
                ],
                    /* 'clientOptions' => [
                      "lengthMenu" => [[15, -1], [15, Yii::t('app', "All")]], //20 Rows
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
                      ] */
            ]);
            ?>
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