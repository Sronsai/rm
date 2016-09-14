<?php
/* @var $this yii\web\View */

//use fedemotta\datatables\DataTables;
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = 'รายการความเสี่ยงประเภท';

$this->params['breadcrumbs'][] = ['label' => 'รายการความเสี่ยงประเภท', 'url' => ['/report/report6']];
$this->params['breadcrumbs'][] = 'รายการความเสี่ยงประเภท';
?>

<div class="report">
    <center><h1><u>รายการความเสี่ยงประเภท</u></h1></center>


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

            <!--div id="div5">เลือกแผนก :</div-->
            <div id="div6">
                <?php
                $list = yii\helpers\ArrayHelper::map(frontend\models\Type::find()->all(), 'id', 'type_name');
                echo yii\helpers\Html::dropDownList('type', $type, $list, [
                    'prompt' => 'เลือกประเภท',
                    'class' => 'form-control',
                ]);
                ?>
            </div>&nbsp;

            <button class='btn btn-success'>ประมวลผล</button>


        </form>


    </div>



    <div class="panel panel-default">
        <div class="panel-body">
            <?=
//echo yii\grid\GridView::widget([
            GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'showPageSummary' => true, //show แถบสีเหลือง summary
                'responsive' => true,
                'hover' => true,
                'floatHeader' => false,
                'panel' => [
                    //'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> RM</h3>',
                    //'type' => 'info',
                    'before' => '<CENTER><H4><U>ประเภทความเสี่ยงที่เกิดซ้ำ (ตั้งแต่ ต.ค 57)</U></H4></CENTER>',
                //'after' => '',
                //'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
                //'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
                //'footer' => false
                ],
                'columns' => [
                    [
                        'attribute' => 'location_name',
                        'header' => 'หน่วยงานต้นเหตุ',
                        'headerOptions' => ['width' => '100'],
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                    //'location' => ['location' => SORT_DESC],
                    ],
                    [
                        'attribute' => 'type_name',
                        'header' => 'ประเภท',
                        'headerOptions' => ['width' => '100'],
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                    ],
                    [
                        'attribute' => 'sub_type_name',
                        'header' => 'ประเภทย่อย',
                        'headerOptions' => ['width' => '100'],
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                    //'location' => ['location' => SORT_DESC],
                    ],
                    /* [
                      'attribute' => 'total',
                      'header' => 'จำนวน',
                      'headerOptions' => ['width' => '30']
                      ], */
                    [
                        'attribute' => 'total',
                        'header' => 'จำนวน',
                        'headerOptions' => ['width' => '100'],
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                        'width' => '10px',
                        'hAlign' => 'center',
                        'format' => ['decimal', 0],
                        'pageSummary' => true,
                        'pageSummaryOptions' => ['class' => 'text-right text-info'],
                    ],
                ]
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