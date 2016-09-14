<?php

use dosamigos\gallery\Gallery;
use kartik\detail\DetailView;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use dixonsatit\thaiYearFormatter\ThaiYearFormatter;

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Risk Meds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?php $id = Yii::$app->request->get('id'); //Get ID มาแสดง    ?>  

<div align=right>
    <?= Html::a(' Print', ['risk-med/pdf', 'id' => $id], ['class' => 'glyphicon glyphicon-print btn btn-success btn-lg', 'target' => '_blank']); ?>
    <!--?= Html::a('', ['risk/update', 'id' => $id], ['class' => 'glyphicon glyphicon-pencil btn btn-info btn-lg']); ?-->
    <!--?= Html::a('', ['risk/delete', 'id' => $id], ['class' => 'glyphicon glyphicon-trash btn btn-danger btn-lg']); ?-->
    <?= '<br /><br />' ?>
</div>


<div class="risk-med-view">

    <p>
        <!--?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?-->
        <!--?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
            ],
            ]) ?>
        </p-->

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
                [
                    'attribute' => 'person_id',
                    'value' => $model->person->person_type,
                ],
                'hn',
                [
                    'label' => 'ชื่อ-สกุล',
                    'value' => $model->pname . $model->fname . ' ' . $model->lname,
                ],
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
                /* 'value' => Yii::$app->thaiFormatter->asDate($model->risk_date, 'full') . ' เวลา ' . Yii::$app->thaiFormatter->asTime($model->risk_date, 'medium') . ' น.', */
                /* 'value' => 'วันที่ ' . Yii::$app->thaiFormatter->asDate($model->risk_date, 'long') . ' เวลา ' . Yii::$app->thaiFormatter->asTime($model->risk_date, 'medium') . ' น.', */
                ],
                //'risk_report',
                [
                    'attribute' => 'risk_report',
                //'value' => 'risk_date',
                /* 'value' => 'วันที่ ' . Yii::$app->thaiFormatter->asDate($model->risk_report, 'long') . ' เวลา ' . Yii::$app->thaiFormatter->asTime($model->risk_report, 'medium') . ' น.', */
                ],
                //'risk_summary:ntext',
                [
                    'format' => 'html',
                    'label' => 'สรุปเหตุการณ์',
                    'value' => '<span style="color:red;">' . $model->risk_summary . '</span>'
                ],
                [
                    'attribute' => 'type_med_id',
                    'value' => $model->typeMed->type_name,
                ],
                [
                    'attribute' => 'sub_med_type_id',
                    'value' => $model->subMedType->sub_med_type_name,
                ],
                [
                    'attribute' => 'level_id',
                    'value' => $model->level->level_name,
                ],
                /* 'clear_id',
                  'system_id',
                  'status_id',
                  'risk_review:ntext', */
                [
                    'attribute' => 'type_clinic_id',
                    'value' => $model->typeClinic->clinic_name,
                ],
                [
                    'format' => 'html',
                    'attribute' => 'status_id',
                    //'value' => '<span style="color:green;">'.'<u>' .$model->status->status_name .'</u>'.'</span>'
                    'value' => $model->status_id == 2 ? "<i class=\"fa fa-thumbs-o-up fa-2x\"></i>" : "<i class=\"fa fa-spinner fa-pulse fa-2x\"></i>"
                ],
                //'type_clinic_id',
                [
                    'format' => 'html',
                    'label' => 'สรุปการทบทวน / แนวทาง',
                    'value' => '<span style="color:green;">' . $model->risk_review . '</span>'
                ],
                [
                    'attribute' => 'join_status',
                //'value' => $model->join_status,
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

<div>
