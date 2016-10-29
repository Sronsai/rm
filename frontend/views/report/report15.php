<?php
/* @var $this yii\web\View */

//use fedemotta\datatables\DataTables;
use kartik\grid\GridView;
use frontend\models\Risk;
use yii\helpers\Html;

$this->title = 'รายงาน 10 อันดับทาง Clinic / Non Clinic';

$this->params['breadcrumbs'][] = ['label' => 'รายงาน 10 อันดับทาง Clinic / Non Clinic', 'url' => ['/report/report15']];
$this->params['breadcrumbs'][] = 'รายงาน 10 อันดับทาง Clinic / Non Clinic';
?>


<div class="report">
    <center><h1><u>รายงาน 10 อันดับทาง Clinic / Non Clinic </u></h1></center>



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
        <div class = "col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
//echo yii\grid\GridView::widget([
                    echo \kartik\grid\GridView::widget([
                        //echo DataTables::widget([
                        'dataProvider' => $dataProvider1,
                        'panel' => [
                            'before' => 'Clinic'
                        ],
                        'export' => [
                            'showConfirmAlert' => false,
                            'target' => GridView::TARGET_BLANK
                        ],
                        'columns' => [
                            [
                                'attribute' => 'sub_type_name',
                                'header' => 'ประเภท',
                                'headerOptions' => ['width' => '30'],
                                'headerOptions' => ['class' => 'text-center'],
                            ],
                            [
                                'attribute' => 'type',
                                'header' => 'ครั้ง',
                                'headerOptions' => ['width' => '20'],
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                            ],
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <div class = "col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
//echo yii\grid\GridView::widget([
                    echo \kartik\grid\GridView::widget([
                        //echo DataTables::widget([
                        'dataProvider' => $dataProvider2,
                        'panel' => [
                            'before' => 'Non Clinic'
                        ],
                        'export' => [
                            'showConfirmAlert' => false,
                            'target' => GridView::TARGET_BLANK
                        ],
                        'columns' => [
                            [
                                'attribute' => 'sub_type_name',
                                'header' => 'ประเภท',
                                'headerOptions' => ['width' => '30'],
                                'headerOptions' => ['class' => 'text-center'],
                                                            ],
                            [
                                'attribute' => 'type',
                                'header' => 'ครั้ง',
                                'headerOptions' => ['width' => '20'],
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