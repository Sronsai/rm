<?php
/* @var $this yii\web\View */

//Yii::$app->request->get('id');
//print_r($id);
use dosamigos\gallery\Gallery;
use yii\helpers\Html;

$time = time();
?>

<div class="risk-pdf">
    <div class="container">

        <center>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <!--img src="../images/logo.png" alt="Smiley face" height="120" width="120"-->
            <?= Html::img(Yii::getAlias('@frontend') . '/images/logo_MOPH.png', ['width' => 120]) ?>
        </center>
        <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>แบบฟอร์มรายงานความเสี่ยง รพ.เชียงคาน</b></h3>

        <p>ใบรายงานความเสี่ยงเลขที่ : <?= $model->id; ?></p> 

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>เหตุการณ์เกิดกับ :</td>
                    <td><?= $model->person->person_type; ?></td>
                </tr>
                <tr>
                    <td>HN :</td>
                    <td><?= $model->hn; ?></td>
                </tr>
                <tr>
                    <td>ชื่อ-สกุล :</td>
                    <td><?= $model->pname; ?><?= $model->fname; ?>   <?= $model->lname; ?></td>
                </tr>
                <tr>
                    <td>หน่วยงานต้นเหตุ  :</td>
                    <td><?= $model->locationRiks->location_name; ?></td>
                </tr>
                <tr>
                    <td>หน่วยงานที่เกี่ยวข้อง  :</td>
                    <td><?= $model->locationConnection->location_name; ?></td>
                </tr>
                <tr>
                    <td>หน่วยงานที่รายงาน  :</td>
                    <td><?= $model->locationReport->location_name; ?></td>
                </tr>
                <tr>
                    <td>วันที่เกิดเหตุ/เวลา :</td>
                    <td><?= 'วันที่ ' . Yii::$app->thaiFormatter->asDate($model->risk_date, 'long') . ' เวลา ' . $time_risk_date ?> น. </td>
                </tr>
                <tr>
                    <td>วันที่รายงาน/เวลา :</td>
                    <td><?= 'วันที่ ' . Yii::$app->thaiFormatter->asDate($model->risk_report, 'long') . ' เวลา ' . $time_risk_report ?> น. </td>
                </tr>
                <tr>
                    <td>สรุปเหตุการณ์ :</td>
                    <td><?= '<span style="color:red;">' . $model->risk_summary . '</span>' ?></td>
                </tr>
                <tr>
                    <td>ประเภท :</td>
                    <td><?= $model->type->type_name; ?></td>
                </tr>
                <tr>
                    <td>ประเภทย่อย :</td>
                    <td><?= $model->subType->sub_type_name; ?></td>
                </tr>
                <tr>
                    <td>ระดับ :</td>
                    <td><?= $model->level->level_name; ?></td>
                </tr>
                <tr>
                    <td>คลิกนิก :</td>
                    <td><?= $model->typeClinic->clinic_name; ?></td>
                </tr>
                <tr>
                    <td>การทบทวน :</td>
                    <td><?= '<span style="color:green;">' . '<u>' . $model->status->status_name . '</u>' . '</span>' ?></td>
                </tr>
                <tr>
                    <td>สรุปการทบทวน :</td>
                    <td><?= '<span style="color:green;">' . $model->risk_review . '</span>' ?></td>
                </tr>
                <tr>
                    <td>ผู้ร่วมทบทวน :</td>
                    <td><?= $model->join_status; ?></td>
                </tr>
                <!--tr>
                    <td>เอกสารทบทวน :</td>
                    <td><?= $model->listDownloadFiles('docs'); ?></td>
                </tr-->
                <tr>
                    <td>รูปภาพ :</td>
                    <td><center>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?= Gallery::widget(['items' => $model->getThumbnails($model->ref, $model->risk_review)]); ?>
                    </div>
                </div>
            </center></td>
            </tr>
            </tbody>
        </table>




        <br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        (.....................................................)


        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        (.....................................................)<br />







        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong><i>....................................................</i></strong>


        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong><i>พญ.ระพีพรรณ จันทร์อ้วน</i></strong>






        <br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong><i>หัวหน้ากลุ่มงาน</i></strong>







        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong><i>ผู้อำนวยการโรงพยาบาลเชียงคาน</i></strong>
        <br /><br />          

        <center>
            <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                พิมพ์เมื่อวันที่ : <?= Yii::$app->thaiFormatter->asDate($time, 'medium'); ?>
            </p> 
        </center>





    </div>
</div>