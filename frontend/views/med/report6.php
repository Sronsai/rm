<?php
/* @var $this yii\web\View */

//use fedemotta\datatables\DataTables;
use kartik\grid\GridView;
use frontend\models\Risk;
use yii\helpers\Html;

$this->title = 'รายงานแยกตามประเภทความเสี่ยง (ยา)';

$this->params['breadcrumbs'][] = ['label' => 'รายงานแยกตามประเภทความเสี่ยง (ยา)', 'url' => ['/med/report6']];
$this->params['breadcrumbs'][] = 'รายงานแยกตามประเภทความเสี่ยง (ยา)';
?>


<div class="report">
    <center><h1><u>รายงานแยกตามประเภทความเสี่ยง (ยา) </u></h1></center>

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


    <div class="col-md-12">
        <div class = "col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
//echo yii\grid\GridView::widget([
                    echo \kartik\grid\GridView::widget([
                        //echo DataTables::widget([
                        'dataProvider' => $dataProvider,
                        'panel' => [
                            'before' => 'รายงานแยกตามประเภทความเสี่ยง (ยา)'
                        ],
                        'export' => [
                            'showConfirmAlert' => false,
                            'target' => GridView::TARGET_BLANK
                        ],
                        'columns' => [
                            [
                                'attribute' => 'sub_med_type_name',
                                'header' => 'ประเภทย่อย (ยา)',
                                'headerOptions' => ['width' => '100'],
                                'headerOptions' => ['class' => 'text-center'],
                                //'contentOptions' => ['class' => 'text-center'],
                            ],
                            [
                                'attribute' => 'total',
                                'header' => 'ครั้ง',
                                'headerOptions' => ['width' => '100'],
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                            ],
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>

    </div>


</div>