<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\BootstrapAsset;
use backend\assets\AppAsset;

$this->title = 'Risk Management For Administrators';
?>
<div class="site-index">

    <center>
        <div class="row">
            <h1>หน้าบริหารจัดการระบบสำหรับผู้ดูแลระบบ</h1><BR />
            <!--p class="lead">( Welcome To Risk Management For Administrators )</p-->

            <p><!--a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a--></p>
        </div>
    </center>

    <div class="body-content">

        <div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading"><center><H4>จัดการผู้ใช้งาน</h4><center></div>
                            <div class="panel-body"></br>
                                <a class="list-group-item" href="?r=user/index"><i class="fa fa-user fa-2x"></i>&nbsp;&nbsp;&nbsp; จัดการผู้ใช้งาน User+Pass</a></br>
                                <a class="list-group-item" href="?r=person/index"><i class="fa fa-bullhorn fa-2x"></i>&nbsp;&nbsp;&nbsp; เหตุการณ์เกิดกับ</a></br></br>
                                <!--a class="list-group-item" href="?r=person/index"><i class="fa fa-shield fa-2x"></i>&nbsp;&nbsp;&nbsp; คำนำหน้า</a-->
                            </div>
                            </div>
                            </div>

                            <div class="col-md-4">
                                <div class="panel panel-info">
                                    <div class="panel-heading"><center><H4>สถานที่</h4><center></div>
                                                <div class="panel-body">
                                                    <a class="list-group-item" href="?r=location-riks/index"><i class="fa fa-map-marker fa-2x"></i>&nbsp;&nbsp;&nbsp; หน่วยงานต้นเหตุ</a></br>
                                                    <a class="list-group-item" href="?r=location-connection/index"><i class="fa fa-sitemap fa-2x"></i>&nbsp;&nbsp;&nbsp; หน่วยงานที่เกี่ยวข้อง</a></br>
                                                    <a class="list-group-item" href="?r=location-report/index"><i class="fa fa-sitemap fa-2x"></i>&nbsp;&nbsp;&nbsp; หน่วยงานที่รายงาน</a>
                                                </div>
                                                </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="panel panel-warning">
                                                        <div class="panel-heading"><center><H4>ประเภทความเสี่ยง</h4><center></div>
                                                                    <div class="panel-body">
                                                                        <a class="list-group-item" href="?r=type/index"><i class="fa fa-wheelchair fa-2x"></i>&nbsp;&nbsp;&nbsp; ประเภท</a></br>
                                                                        <a class="list-group-item" href="?r=sub-type/index"><i class="fa fa-eye-slash fa-2x"></i>&nbsp;&nbsp;&nbsp; ประเภทย่อย</a></br>
                                                                        <a class="list-group-item" href="?r=level/index"><i class="fa fa-spinner fa-2x"></i>&nbsp;&nbsp;&nbsp; ระดับความรุนแรง</a>
                                                                    </div>
                                                                    </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="panel panel-danger">
                                                                            <div class="panel-heading"><center><H4>สาเหตุ</h4><center></div>
                                                                                        <div class="panel-body">
                                                                                            <div class="col-md-6">
                                                                                                <div class="panel-body">
                                                                                                    <a class="list-group-item" href="?r=clear/index"><i class="fa fa-anchor fa-2x"></i>&nbsp;&nbsp;&nbsp; สาเหตุที่ชัดเจน</a>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-6">
                                                                                                <div class="panel-body">
                                                                                                    <a class="list-group-item" href="?r=system/index"><i class="fa fa-arrows fa-2x"></i>&nbsp;&nbsp;&nbsp; สาเหตุเชิงระบบ</a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>      
                                                                                        </div>
                                                                                        </div>
                                                                                        </div>

                                                                                        </div>
