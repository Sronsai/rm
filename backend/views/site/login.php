<?php

namespace common\models;

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'เข้าสู่ระบบ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <center>
        <h1><?= Html::encode($this->title) ?></h1>

        <p>สำหรับผู้ดูแลระบบ</p>
    </center>

    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <!--?= $form->field($model, 'rememberMe')->checkbox() ?-->
            <center> 
                <div class="form-group">
                    <?= Html::submitButton('Go', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </center>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
