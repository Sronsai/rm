<?php

//use yii\widgets\DetailView;
use dosamigos\gallery\Gallery;
use kartik\detail\DetailView;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use dixonsatit\thaiYearFormatter\ThaiYearFormatter;

//use kartik\social\FacebookPlugin;

/* @var $this yii\web\View */
/* @var $model frontend\models\Risk */


$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'บันทึกความเสี่ยง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>

<?php $id = Yii::$app->request->get('id'); //Get ID มาแสดง  ?>  

<div align=right>
    <?= Html::a('', ['risk/pdf', 'id' => $id], ['class' => 'glyphicon glyphicon-print btn btn-success btn-lg']); ?>
    <?= Html::a('', ['risk/update', 'id' => $id], ['class' => 'glyphicon glyphicon-pencil btn btn-info btn-lg']); ?>
    <?= Html::a('', ['risk/delete', 'id' => $id], ['class' => 'glyphicon glyphicon-trash btn btn-danger btn-lg']); ?>
    <?= '<br /><br />' ?>
</div>

<!--center>
    <h2><u>แบบฟอร์มใบรายงานความเสี่ยง รพ.เชียงคาน</u></h2>
    <small>ใบรายงานความเสี่ยงที่ : <?= $model->id; ?></small>
</center-->


<div class="risk-view">

    <!--h1><?= Html::encode($this->title) ?></h1-->
    <!--center>
        <p>
    <!--?= Html::a('ภาพรวม', ['site/index'], ['class' => 'btn btn-success']) ?>
    <!--?= Html::a('ทบทวน', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <!--?=
    Html::a('ลบ', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'ยืนยันการลบข้อมูล',
            'method' => 'post',
        ],
    ])
    ?-->
    <!--/p>
</center-->


    <?=
    DetailView::widget([
        'model' => $model, //ค่า array ที่จะนำไปแสดงผล รับค่าเป็น array 1 มิติ
        'condensed' => true,
        'hover' => true,
        'mode' => DetailView::MODE_VIEW,
        'panel' => [
            'heading' => 'ใบรายงานความเสี่ยงเลขที่ : ' . $model->id,
            'type' => DetailView::TYPE_INFO,
        /* 'before' => '',
          'after' => '', */
        ],
        'attributes' => [
            //'id',
            /* [
              'format' => 'html',
              'label' => 'เหตุการณ์เกิดกับ',
              'value' => '<span style="color:green;">' . $model->person->person_type . '</span>'
              ], */
            [
                'attribute' => 'person_id',
                'value' => $model->person->person_type,
            ],
            'hn',
            [
                'label' => 'ชื่อ-สกุล',
                'value' => $model->pname . $model->fname . ' ' . $model->lname,
            ],
            /* 'pname',
              'fname',
              'lname', */
            [
                'attribute' => 'location_riks_id',
                'value' => $model->locationRiks->location_name,
            ],
            [
                'attribute' => 'location_connection_id',
                'value' => $model->locationConnection->location_name,
            ],
            [
                'attribute' => 'location_report_id',
                'value' => $model->locationReport->location_name,
            ],
            //'risk_date',
            [
                'attribute' => 'risk_date',
                //'value' => 'risk_date',
                'value' => Yii::$app->thaiFormatter->asDate($model->risk_date, 'full') .' เวลา '. Yii::$app->thaiFormatter->asTime($model->risk_date, 'medium') . ' น.',
                
            ],
            //'risk_report',
            [
                'attribute' => 'risk_report',
                //'value' => 'risk_date',
                'value' => Yii::$app->thaiFormatter->asDate($model->risk_report, 'full') .' เวลา '. Yii::$app->thaiFormatter->asTime($model->risk_report,'medium') . ' น.',
                
            ],
            //'risk_summary:ntext',
            [
                'format' => 'html',
                'label' => 'สรุปเหตุการณ์',
                'value' => '<span style="color:red;">' . $model->risk_summary . '</span>'
            ],
            [
                'attribute' => 'type_id',
                'value' => $model->type->type_name,
            ],
            [
                'attribute' => 'sub_type_id',
                'value' => $model->subType->sub_type_name,
            ],
            [
                'attribute' => 'level_id',
                'value' => $model->level->level_name,
            ],
            /* [
              'attribute' => 'clear_id',
              'value' => $model->clear->clear_name,
              ],
              [
              'attribute' => 'system_id',
              'value' => $model->system->system_name,
              ], */
            [
                'attribute' => 'type_clinic_id',
                'value' => $model->typeClinic->clinic_name,
            ],
            [
                'attribute' => 'status_id',
                'value' => $model->status->status_name,
            ],
            /* [
              'attribute' => 'risk_review',
              ], */
            [
                'format' => 'html',
                'label' => 'สรุปการทบทวน',
                'value' => '<span style="color:green;">' . $model->risk_review . '</span>'
            ],
            [
                'attribute' => 'docs',
                'value' => $model->listDownloadFiles('docs'),
                'format' => 'html'
            ],
        ],
    ])
    ?>

</div>

<center>
    <div class="panel panel-default">
        <div class="panel-body">
            <?= Gallery::widget(['items' => $model->getThumbnails($model->ref, $model->risk_review)]); ?>
        </div>
    </div>
</center>

<!--?php echo FacebookPlugin::widget(['type' => FacebookPlugin::COMMENT, 'settings' => ['data-width' => 1000, 'data-numposts' => 5]]); ?-->


