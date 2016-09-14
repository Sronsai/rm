<?php
/* @var $this yii\web\View */

use fedemotta\datatables\DataTables;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

$this->title = 'รายงาน (ยา) เฉพาะ OPD IPD';

//use yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => 'รายงาน (ยา) เฉพาะ OPD IPD', 'url' => ['/report/index']];
$this->params['breadcrumbs'][] = 'รายงาน (ยา) เฉพาะ OPD IPD';
?>

<div class="report">
    <center><h1><u>รายงาน (ยา) เฉพาะ OPD IPD</u></h1></center>


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
            echo \kartik\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                /* 'panel' => [
                  'before' => '<u><h3>ใบความเสี่ยง (ยา) แยกเฉพาะ OPD IPD</h3></u>'
                  ], */
                'export' => [
                    'showConfirmAlert' => false,
                    'target' => GridView::TARGET_BLANK
                ],
                'columns' => [
                    [
                        'attribute' => 'Department',
                        'header' => 'Department',
                        'headerOptions' => ['width' => '30'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center']
                    ],
                    [
                        'attribute' => 'Administrator Error',
                        'header' => 'Administrator Error',
                        'headerOptions' => ['width' => '20'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center']
                    ],
                    [
                        'attribute' => 'Dispensing Error',
                        'header' => 'Dispensing Error',
                        'headerOptions' => ['width' => '20'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center']
                    ],
                    [
                        'attribute' => 'Proscribing Error',
                        'header' => 'Proscribing Error',
                        'headerOptions' => ['width' => '100'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center']
                    ],
                    [
                        'attribute' => 'Processing Error',
                        'header' => 'Processing Error',
                        'headerOptions' => ['width' => '70'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center']
                    ],
                ],
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

