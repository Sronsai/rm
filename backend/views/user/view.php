<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'จัดการผู้ใช้', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <div class="panel panel-default">
        <div class="panel-heading"><center><H1>ผู้ใช้งานลำดับที่ :<?= Html::encode($this->title) ?></H1></center></div>
        <div class="panel-body">


            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'id',
                    'username',
                    'email:email',
                    'statusName',
                    'created_at:dateTime',
                    'updated_at:dateTime',
                    'roleName',
                ],
            ])
            ?>


            <center>
                <p>
                    <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
                    <?=
                    Html::a('ลบ', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'ยืนยันการลบข้อมูล ?',
                            'method' => 'post',
                        ],
                    ])
                    ?>
                </p>
            </center>


        </div>
    </div>
</div>
