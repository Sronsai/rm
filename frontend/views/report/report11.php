<?php
/* @var $this yii\web\View */

//use fedemotta\datatables\DataTables;
use kartik\grid\GridView;
use frontend\models\Risk;
use yii\helpers\Html;

$this->title = 'รายงานความเสี่ยงการทบทวน/ไม่ทบทวน';

$this->params['breadcrumbs'][] = ['label' => 'รายการความเสี่ยงการทบทวน/ไม่ทบทวน', 'url' => ['/report/report11']];
$this->params['breadcrumbs'][] = 'รายการความเสี่ยงการทบทวน/ไม่ทบทวน';
?>


<div class="report">
    <center><h1><u>รายการความเสี่ยงการทบทวน/ไม่ทบทวน เลือกช่วงวัน</u></h1></center>



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
                        'attribute' => 'location_name',
                        'header' => 'แผนก',
                        'headerOptions' => ['width' => '100'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                    [
                        'attribute' => 'total',
                        'header' => 'ใบความเสี่ยงทั้งหมด / ใบ',
                        'headerOptions' => ['width' => '100'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                    [
                        'attribute' => 'status1',
                        'header' => 'ต้องทบทวน',
                        'headerOptions' => ['width' => '100'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                    [
                        'attribute' => 'status2',
                        'header' => 'ทบทวนแล้ว',
                        'headerOptions' => ['width' => '100'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
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
                ]
            ]);
            ?>
        </div>
    </div>


</div>