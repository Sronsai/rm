<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Risk */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'บันทึกความเสี่ยง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risk-view">

    <!--h1><?= Html::encode($this->title) ?></h1-->

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'attribute' => 'person_id',
                //'value' => 'locationRiks.person_type',
                 'value' => $model->person->person_type,
            ],
            'hn',
            'pname',
            'fname',
            'lname',
            [
                'attribute' => 'location_riks_id',
                 'value' => $model->locationRiks->location_name,
            ],
            [
                'attribute' => 'location_report_id',
                 'value' => $model->locationReport->location_name,
            ],
            [
                'attribute' => 'location_connection_id',
                 'value' => $model->locationConnection->location_name,
            ],
            'risk_date',
            'risk_report',
            'risk_summary:ntext',
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
            [
                'attribute' => 'clear_id',
                 'value' => $model->clear->clear_name,
            ],
            [
                'attribute' => 'system_id',
                 'value' => $model->system->system_name,
            ],
            [
                'attribute' => 'status_id',
                 'value' => $model->status->status_name,
            ],
        ],
    ])
    ?>

</div>
