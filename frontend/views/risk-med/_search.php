<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\RiskMedSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="risk-med-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'person_id') ?>

    <?= $form->field($model, 'hn') ?>

    <?= $form->field($model, 'pname') ?>

    <?= $form->field($model, 'fname') ?>

    <?php // echo $form->field($model, 'lname') ?>

    <?php // echo $form->field($model, 'location_riks_id') ?>

    <?php // echo $form->field($model, 'location_report_id') ?>

    <?php // echo $form->field($model, 'location_connection_id') ?>

    <?php // echo $form->field($model, 'risk_date') ?>

    <?php // echo $form->field($model, 'risk_report') ?>

    <?php // echo $form->field($model, 'risk_summary') ?>

    <?php // echo $form->field($model, 'type_id') ?>

    <?php // echo $form->field($model, 'sub_type_id') ?>

    <?php // echo $form->field($model, 'level_id') ?>

    <?php // echo $form->field($model, 'clear_id') ?>

    <?php // echo $form->field($model, 'system_id') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'risk_review') ?>

    <?php // echo $form->field($model, 'type_clinic_id') ?>

    <?php // echo $form->field($model, 'join_status') ?>

    <?php // echo $form->field($model, 'docs') ?>

    <?php // echo $form->field($model, 'ref') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
