<?php
/* @var $this yii\web\View */

use fedemotta\datatables\DataTables;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

$this->title = 'หน่วยงานที่รายงานความเสี่ยง (ยา)';

//use yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => 'หน่วยงานที่รายงานความเสี่ยง (ยา)', 'url' => ['/report/index']];
$this->params['breadcrumbs'][] = 'หน่วยงานที่รายงานความเสี่ยง (ยา)';
?>

<div class="report">
    <center><h1><u>หน่วยงานที่รายงานความเสี่ยง (ยา)</u></h1></center>


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
                //'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '0'],
                'panel' => [
                    'before' => ''
                ],
                'export' => [
                    'showConfirmAlert' => false,
                    'target' => GridView::TARGET_BLANK
                ],
                //'dataProvider' => $dataProvider,
                //'responsive' => TRUE,
                //'hover' => true,
                //'floatHeader' => true,
                //'panel' => [
                //'before' => 'ประมวลผลข้อมูล จากวันที่  ' . $date1 . '   ถึงวันที่   ' . $date2 . '',
                //'type' => \kartik\grid\GridView::TYPE_SUCCESS,
                //'after' => 'โดย ' . $dev
                //],
                'columns' => [
                    /* [
                      'attribute' => 'risk_date',
                      'header' => 'วันที่เกิดเหตุ',
                      'headerOptions' => ['width' => '80']
                      ], 
                    [
                        'attribute' => 'id',
                        'header' => 'เลขที่',
                        'headerOptions' => ['width' => '30']
                    ],*/
                    [
                        'attribute' => 'location_name',
                        'header' => 'หน่วยงานที่รายงานความเสี่ยง',
                        'headerOptions' => ['width' => '20']
                    ],
                    [
                        'attribute' => 'total',
                        'header' => 'จำนวนครั้ง',
                        'headerOptions' => ['width' => '100']
                    ],
                    /*[
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
                      ], 
                    [
                        'attribute' => 'risk_summary',
                        'header' => 'รายละเอียดความเสี่ยง',
                        'headerOptions' => ['width' => '100']
                    ],
                    [
                        'attribute' => 'type',
                        'header' => 'ประเภท',
                        'headerOptions' => ['width' => '100']
                    ],
                    [
                        'attribute' => 'level_e',
                        'header' => 'ระดับ',
                        'headerOptions' => ['width' => '20']
                    ],
                    [
                        'attribute' => 'risk_review',
                        'header' => 'สรุปการทบทวน / แนวทาง',
                        'headerOptions' => ['width' => '100']
                    ],
                    [
                        'attribute' => 'status',
                        'header' => 'ทบทวน',
                        'headerOptions' => ['width' => '70']
                    ],*/
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

