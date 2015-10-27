<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ReferoutSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="referout-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'refer_no') ?>

    <?= $form->field($model, 'refertype_id') ?>

    <?= $form->field($model, 'refer_date') ?>

    <?= $form->field($model, 'refer_time') ?>

    <?= $form->field($model, 'station_id') ?>

    <?php // echo $form->field($model, 'location_id') ?>

    <?php // echo $form->field($model, 'cid') ?>

    <?php // echo $form->field($model, 'hn') ?>

    <?php // echo $form->field($model, 'pname') ?>

    <?php // echo $form->field($model, 'fname') ?>

    <?php // echo $form->field($model, 'lname') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'addrpart') ?>

    <?php // echo $form->field($model, 'moopart') ?>

    <?php // echo $form->field($model, 'tmbpart') ?>

    <?php // echo $form->field($model, 'amppart') ?>

    <?php // echo $form->field($model, 'chwpart') ?>

    <?php // echo $form->field($model, 'pttype_id') ?>

    <?php // echo $form->field($model, 'pttypeno') ?>

    <?php // echo $form->field($model, 'hospmain') ?>

    <?php // echo $form->field($model, 'hospsub') ?>

    <?php // echo $form->field($model, 'typept_id') ?>

    <?php // echo $form->field($model, 'strength_id') ?>

    <?php // echo $form->field($model, 'doctor_id') ?>

    <?php // echo $form->field($model, 'refer_hospcode') ?>

    <?php // echo $form->field($model, 'cause_referout_id') ?>

    <?php // echo $form->field($model, 'expire_date') ?>

    <?php // echo $form->field($model, 'loads_id') ?>

    <?php // echo $form->field($model, 'is_coordinate_doctor') ?>

    <?php // echo $form->field($model, 'is_coordinate_nurse') ?>

    <?php // echo $form->field($model, 'coordinate_id') ?>

    <?php // echo $form->field($model, 'image1') ?>

    <?php // echo $form->field($model, 'is_upload') ?>

    <?php // echo $form->field($model, 'is_download') ?>

    <?php // echo $form->field($model, 'is_receive') ?>

    <?php // echo $form->field($model, 'image2') ?>

    <?php // echo $form->field($model, 'image3') ?>

    <?php // echo $form->field($model, 'image4') ?>

    <?php // echo $form->field($model, 'image5') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'is_coordinate_not') ?>

    <?php // echo $form->field($model, 'is_coordinate_no') ?>

    <?php // echo $form->field($model, 'is_dead_refer') ?>

    <?php // echo $form->field($model, 'is_dead_er') ?>

    <?php // echo $form->field($model, 'is_dead_ward') ?>

    <?php // echo $form->field($model, 'memo') ?>

    <?php // echo $form->field($model, 'memodiag') ?>

    <?php // echo $form->field($model, 'drugallergy') ?>

    <?php // echo $form->field($model, 'doctor_name') ?>

    <?php // echo $form->field($model, 'cc') ?>

    <?php // echo $form->field($model, 'user_save') ?>

    <?php // echo $form->field($model, 'vn') ?>

    <?php // echo $form->field($model, 'conscious') ?>

    <?php // echo $form->field($model, 'e') ?>

    <?php // echo $form->field($model, 'v') ?>

    <?php // echo $form->field($model, 'm') ?>

    <?php // echo $form->field($model, 'evm_total') ?>

    <?php // echo $form->field($model, 'pupil_right') ?>

    <?php // echo $form->field($model, 'pupil_left') ?>

    <?php // echo $form->field($model, 't') ?>

    <?php // echo $form->field($model, 'p') ?>

    <?php // echo $form->field($model, 'r') ?>

    <?php // echo $form->field($model, 'bp') ?>

    <?php // echo $form->field($model, 'Send_spclty_id') ?>

    <?php // echo $form->field($model, 'load_time') ?>

    <?php // echo $form->field($model, 'spo2') ?>

    <?php // echo $form->field($model, 'clinicgroup') ?>

    <?php // echo $form->field($model, 'clinicsub') ?>

    <?php // echo $form->field($model, 'load_date') ?>

    <?php // echo $form->field($model, 'vst_date') ?>

    <?php // echo $form->field($model, 'station_name') ?>

    <?php // echo $form->field($model, 'father') ?>

    <?php // echo $form->field($model, 'mother') ?>

    <?php // echo $form->field($model, 'location_name') ?>

    <?php // echo $form->field($model, 'pttype_name') ?>

    <?php // echo $form->field($model, 'forward_flag') ?>

    <?php // echo $form->field($model, 'from_hospcode') ?>

    <?php // echo $form->field($model, 'save_date') ?>

    <?php // echo $form->field($model, 'save_time') ?>

    <?php // echo $form->field($model, 'warfarin_note') ?>

    <?php // echo $form->field($model, 'app_date') ?>

    <?php // echo $form->field($model, 'ett_no') ?>

    <?php // echo $form->field($model, 'ett_mark') ?>

    <?php // echo $form->field($model, 'sync_memo') ?>

    <?php // echo $form->field($model, 'refer_no_his') ?>

    <?php // echo $form->field($model, 'level_acute') ?>

    <?php // echo $form->field($model, 'cause_referout_etc') ?>

    <?php // echo $form->field($model, 'is_consult') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
