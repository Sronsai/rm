<?php
/* @var $this yii\web\View */

use fedemotta\datatables\DataTables;
use kartik\grid\GridView;

$this->title = 'รายงานความเสี่ยงระบบยาและสารน้ำประจำเดือน';

$this->params['breadcrumbs'][] = ['label' => 'รายงานความเสี่ยงระบบยาและสารน้ำประจำเดือน ', 'url' => ['/report/report5']];
$this->params['breadcrumbs'][] = 'รายงานความเสี่ยงระบบยาและสารน้ำประจำเดือน ';

$date1 = date('Y-m-1');
$date2 = date('Y-m-31');
?>

<div class="report">
    <center><h1><u>รายงานความเสี่ยงระบบยาและสารน้ำประจำเดือน
                <?php
                $command = Yii::$app->db->createCommand(" SELECT COUNT(id) FROM risk_med WHERE risk_date BETWEEN '$date1' and '$date2' ");
                $target = $command->queryScalar();
                echo $target;
                ?>
                รายการ
            </u></h1></center>



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
                      ], */
                    [
                        'attribute' => 'id',
                        'header' => 'เลขที่',
                        'headerOptions' => ['width' => '30']
                    ],
                    [
                        'attribute' => 'hn',
                        'header' => 'HN'
                        ,
                        'headerOptions' => ['width' => '20']
                    ],
                    [
                        'attribute' => 'fullname',
                        'header' => 'ชื่อ-นามสกุล',
                        'headerOptions' => ['width' => '130']
                    ],
                    [
                        'attribute' => 'location_name',
                        'header' => 'หน่วยงานที่เกิดเหตุ',
                        'headerOptions' => ['width' => '130']
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
                      ], */
                    [
                        'attribute' => 'risk_summary',
                        'header' => 'รายละเอียดความเสี่ยง'
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