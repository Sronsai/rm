<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Referout */

$this->title = $model->refer_no;
$this->params['breadcrumbs'][] = ['label' => 'Referouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referout-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->refer_no], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->refer_no], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'refer_no',
            'refertype_id',
            'refer_date',
            'refer_time',
            'station_id',
            'location_id',
            'cid',
            'hn',
            'pname',
            'fname',
            'lname',
            'age',
            'addrpart',
            'moopart',
            'tmbpart',
            'amppart',
            'chwpart',
            'pttype_id',
            'pttypeno',
            'hospmain',
            'hospsub',
            'typept_id',
            'strength_id',
            'doctor_id',
            'refer_hospcode',
            'cause_referout_id',
            'expire_date',
            'loads_id',
            'is_coordinate_doctor',
            'is_coordinate_nurse',
            'coordinate_id',
            'image1',
            'is_upload',
            'is_download',
            'is_receive',
            'image2',
            'image3',
            'image4',
            'image5',
            'sex',
            'is_coordinate_not',
            'is_coordinate_no',
            'is_dead_refer',
            'is_dead_er',
            'is_dead_ward',
            'memo:ntext',
            'memodiag:ntext',
            'drugallergy',
            'doctor_name',
            'cc',
            'user_save',
            'vn',
            'conscious',
            'e',
            'v',
            'm',
            'evm_total',
            'pupil_right',
            'pupil_left',
            't',
            'p',
            'r',
            'bp',
            'Send_spclty_id',
            'load_time',
            'spo2',
            'clinicgroup',
            'clinicsub',
            'load_date',
            'vst_date',
            'station_name',
            'father',
            'mother',
            'location_name',
            'pttype_name',
            'forward_flag',
            'from_hospcode',
            'save_date',
            'save_time',
            'warfarin_note',
            'app_date',
            'ett_no',
            'ett_mark',
            'sync_memo',
            'refer_no_his',
            'level_acute',
            'cause_referout_etc',
            'is_consult',
        ],
    ]) ?>

</div>
