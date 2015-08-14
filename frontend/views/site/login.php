<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'เข้าสู่ระบบ';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../web/css/login.css">

    </head>
    <body>
        <section class="intro"></br>     
            <h1>ระบบบริหารจัดการความเสี่ยง</h1></br></br></br>
            <h4>Risk Management</h4>
            <div class="login-box">
                <div class="text-center">
                    <img src="../images/logo.png" height="150" width="150" alt="">
                </div></br></br>
                <!-- /.login-logo -->
                <div class="login-box-body">
                    <!--p class="login-box-msg">Sign in to start your session</p-->

                    <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

                    <?=
                            $form
                            ->field($model, 'username', $fieldOptions1)
                            ->label(false)
                            ->textInput(['placeholder' => $model->getAttributeLabel('ชื่อผู้ใช้งาน')])
                    ?>

                    <?=
                            $form
                            ->field($model, 'password', $fieldOptions2)
                            ->label(false)
                            ->passwordInput(['placeholder' => $model->getAttributeLabel('รหัสผ่าน')])
                    ?>

                    <div class="row">
                        <div class="text-center">
                               ========================
                                <!--?= $form->field($model, 'rememberMe')->checkbox() ?-->
                        </div>
                    </div></br>

                    <div class="row">
                        <div class="text-center">
                            <div class="col-xs-12">
                                <?= Html::submitButton('เข้าสู่ระบบ', ['class' => 'btn btn-success btn-block btn-flat', 'name' => 'login-button']) ?>
                            </div>
                            </br>
                            <!--div class="col-xs-12">
                                <!--?= Html::a('สมัครสมาชิก', ['site/signup'], ['class' => 'btn btn-primary btn-block btn-flat']) ?>
                            </div-->
                            </br>
                            <div class="col-xs-12">
                                <!--?= Html::a('สำหรับผู้ดูแลระบบ', [''], ['class' => 'btn btn-danger btn-block btn-flat']) ?-->
                                <?= Html::a('สำหรับผู้ดูแลระบบ', Yii::$app->urlManagerBackend->getBaseUrl(), ['class' => 'btn btn-danger btn-block btn-flat']) ?>
                            </div>
                        </div>
                    </div>


                    <!--php ActiveForm::end(); ?>
                    
                            <div class="social-auth-links text-center">
                                <p>- OR -</p>
                                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in
                                    using Facebook</a>
                                <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign
                                    in using Google+</a>
                            </div>
                    
                            <a href="#">I forgot my password</a><br>
                            <a href="register.html" class="text-center">Register a new membership</a>
                    
                        </div-->
                    <!-- /.login-box-body -->
                </div><!-- /.login-box -->

            </div>   
        </section>
    </body>



