<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'จัดการผู้ใช้งาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="panel panel-success">
        <div class="panel-heading"><center><H1><?= Html::encode($this->title) ?></H1></center></div>
        <div class="panel-body">

            <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>


            <p>
                <?= Html::button('เพิ่มข้อมูลผู้ใช้งาน', ['value' => Url::to('index.php?r=user/create'), 'title' => 'เพิ่มข้อมูลผู้ใช้งาน', 'class' => 'btn btn-success', 'id' => 'activity-create-link']); ?>
            </p>
            <!--?= Html::button('เพิ่ม', ['value' => Url::to('index.php?r=user/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?-->


            <?php
            Modal::begin([
                'id' => 'activity-modal',
                'header' => '<h4 class="modal-title">ข้อมูลผู้ใช้งาน</h4>',
                'size' => 'modal-lg',
                'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">ปิด</a>',
            ]);
            Modal::end();
            ?>


            <?php $this->registerJs('
        function init_click_handlers(){
            $("#activity-create-link").click(function(e) {
                    $.get(
                        "index.php?r=user/create",
                        function (data)
                        {
                            $("#activity-modal").find(".modal-body").html(data);
                            $(".modal-body").html(data);
                            $(".modal-title").html("เพิ่มข้อมูลผู้ใช้งาน");
                            $("#activity-modal").modal("show");
                        }
                    );
                });
            $(".activity-view-link").click(function(e) {
                    var fID = $(this).closest("tr").data("key");
                    $.get(
                        "index.php?r=user/view",
                        {
                            id: fID
                        },
                        function (data)
                        {
                            $("#activity-modal").find(".modal-body").html(data);
                            $(".modal-body").html(data);
                            $(".modal-title").html("เปิดดูข้อมูลผู้ใช้งาน");
                            $("#activity-modal").modal("show");
                        }
                    );
                });
            $(".activity-update-link").click(function(e) {
                    var fID = $(this).closest("tr").data("key");
                    $.get(
                        "index.php?r=user/update",
                        {
                            id: fID
                        },
                        function (data)
                        {
                            $("#activity-modal").find(".modal-body").html(data);
                            $(".modal-body").html(data);
                            $(".modal-title").html("แก้ไขข้อมูลผู้ใช้งาน");
                            $("#activity-modal").modal("show");
                        }
                    );
                });
        }
        init_click_handlers(); //first run
        $("#user_pjax_id").on("pjax:success", function() {
          init_click_handlers(); //reactivate links in grid after pjax update
        });'); ?>


            <?php \yii\widgets\Pjax::begin(['id' => 'user_pjax_id']); ?>
            <?=
            \kartik\grid\GridView::widget([
                //GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'responsive' => true,
                'hover' => true,
                'floatHeader' => true,
                'pjax' => true,
                'pjaxSettings' => [
                    'neverTimeout' => true,
                    'enablePushState' => false,
                    'options' => ['id' => 'UserGrid'],
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn',
                        'header' => 'ลำดับ',
                    ],
                    //'id',
                    'username',
                    // 'auth_key',
                    // 'password_hash',
                    // 'password_reset_token',
                    'email:email',
                    //'created_at',
                    'updated_at:dateTime',
                    //'roleName',
                    [
                        'attribute' => 'role',
                        'filter' => User::getItemsAlias('role'),
                        'value' => function($model) {
                            return $model->roleName;
                        }
                    ],
                    //'statusName',
                    [
                        'attribute' => 'status',
                        'filter' => User::getItemsAlias('status'),
                        'value' => function($model) {
                            return $model->statusName;
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'จัดการ',
                        'options' => ['style' => 'width:200px;'],
                        //'buttonOptions' => ['class' => 'btn btn-default'],
                        //'template' => '<div class="btn-group btn-group-sm text-center" role="group"> {view} {update} {delete} </div>',
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                                            'class' => 'activity-view-link',
                                            'title' => 'เปิดดูข้อมูล',
                                            'data-toggle' => 'modal',
                                            'data-target' => '#activity-modal',
                                            'data-id' => $key,
                                            'data-pjax' => '0',
                                ]);
                            },
                                    'update' => function ($url, $model, $key) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
                                            'class' => 'activity-update-link',
                                            'title' => 'แก้ไขข้อมูล',
                                            'data-toggle' => 'modal',
                                            'data-target' => '#activity-modal',
                                            'data-id' => $key,
                                            'data-pjax' => '0',
                                ]);
                            },
                                ]
                            ],
                        ],
                    ]);
                    ?>
                    <?php \yii\widgets\Pjax::end(); ?>



        </div>
    </div></div>
