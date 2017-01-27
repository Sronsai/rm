<?php

namespace frontend\controllers;

use yii;
use frontend\models\LineBot;
use frontend\models\Risk;
use yii\helpers\Url;
use dosamigos\gallery\Gallery;
use yii\helpers\Html;

class LineBotController extends \yii\web\Controller {
    /* public function actionCurl() { //      ส่งจาก risk /
      $last_thread = RiskMed::findOne(['risk_summary' => 'risk_med']);
      $thread = RiskMed::find()->orderBy(['id' => SORT_DESC])->one();
      $thread_photo = RiskMed::find()->orderBy(['id' => SORT_DESC])->one();
      if (!$last_thread) {
      $last_thread = new RiskMed();
      $last_thread_photo = new RiskMed();
      $last_thread->risk_summary = 'risk_med';
      $last_thread->id = $thread->id;
      $last_thread_photo->ref = $thread->ref;
      $last_thread->save();
      //$message = $thread->risk_summary . ' ' . Url::to('http://localhost/rm/frontend/web/riskmed/dr2jTKhT5bhOlnUiSw0nrZ/b5b042132115b2deb8b3f50d6ebf8c51.jpg');
      $message = $thread->risk_summary . ' ' . Gallery::widget((['items' => $last_thread_photo->getThumbnails($last_thread_photo->ref, $last_thread_photo->risk_review)]));
      //$message = $thread->risk_summary . ' ' . Url::to('http://localhost/rm/frontend/web/index.php?r=riskmed/view&id=' . $thread->id);
      //$message = $thread->risk_summary . ' ' .Gallery::widget(['items' => $last_thread_photo->getThumbnails($last_thread_photo->ref, $last_thread_photo->risk_review)]);
      //$message = $thread->risk_summary;
      $res = $this->notify_message($message);
      } else {
      if ($last_thread->last_id != $thread->id) {
      $last_thread_photo->ref = $thread->ref;
      $message = $thread->risk_summary . ' ' . Url::to('http://localhost/rm/frontend/web/riskmed/' . $last_thread_photo->ref, $last_thread_photo->risk_review);
      //$message = $thread->risk_summary . ' ' . Url::to('http://localhost/rm/frontend/web/index.php?r=riskmed/view&id=' . $thread->id);
      //$message = $last_thread_photo->risk_summary . ' ' .Gallery::widget(['items' => $last_thread_photo->getThumbnails($last_thread_photo->ref, $last_thread_photo->risk_review)]);
      //$message = $thread->risk_summary;
      $res = $this->notify_message($message);
      $last_thread->last_id = $thread->id;
      $last_thread->save();
      }
      }
      } */

    //riskmed/dr2jTKhT5bhOlnUiSw0nrZ/b5b042132115b2deb8b3f50d6ebf8c51.jpg

    public function actionCurl($message = null) {

        $last_thread = Risk::findOne(['risk_summary' => 'risk']);
        $thread = Risk::find()->orderBy(['id' => SORT_DESC])->one();
        $thread_photo = Risk::find()->orderBy(['id' => SORT_DESC])->one();
        if (!$last_thread) {
            $last_thread = new Risk();
            $last_thread_photo = new Risk();
            $last_thread->risk_summary = 'risk';
            $last_thread->id = $thread->id;
            $last_thread_photo->ref = $thread->ref;
            $last_thread->save();
            //$message = $thread->risk_summary . ' ' . Url::to('http://localhost/rm/frontend/web/riskmed/dr2jTKhT5bhOlnUiSw0nrZ/b5b042132115b2deb8b3f50d6ebf8c51.jpg');
            $message = $thread->risk_summary;
            $photo_line = substr(Gallery::widget(['items' => $last_thread_photo->getThumbnailsline($last_thread_photo->ref, $last_thread_photo->risk_review)]), 43, 102);
            //$photo_line0 = $last_thread_photo->risk_summary . ' ' . Url::to(Yii::getAlias('@web') . '/riskmed/' . $last_thread_photo->ref, true);
            //$photo_line1 = $last_thread_photo->risk_summary . ' ' . Url::to('http://localhost/rm/frontend/web/riskmed/' . '' . $last_thread_photo->ref);
            //$photo_line2 = $last_thread_photo->ref . ' ' . Gallery::widget(['items' => $last_thread_photo->getThumbnailsline($last_thread_photo->ref, $last_thread_photo->risk_review)]);
            //$message = $thread->risk_summary . ' ' . Url::to('http://localhost/rm/frontend/web/index.php?r=riskmed/view&id=' . $thread->id);
            //$photo_line = $thread->risk_summary . ' ' .Gallery::widget(['items' => $last_thread_photo->getThumbnails($last_thread_photo->ref, $last_thread_photo->risk_review)]);
            //$message = $thread->risk_summary;
            //$res = $this->notify_message($message);
            //$photo_path = $photo_line1.$photo_line2;
            //echo $photo_path;

            $chOne = curl_init();
            curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
// SSL USE
            curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
//POST
            curl_setopt($chOne, CURLOPT_POST, 1);
// Message
            //curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=สวัสดี");
//ถ้าต้องการใส่รุป ให้ใส่ 2 parameter imageThumbnail และimageFullsize
            curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $message . "&imageThumbnail=" . $photo_line . "&imageFullsize=" . $photo_line);
// follow redirects
            curl_setopt($chOne, CURLOPT_FOLLOWLOCATION, 1);
//ADD header array
            $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer 3dV1BSWIrbUdK0ZFqPrfyRiru60dmIJtm0bRmFbZhF1',);
            curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
//RETURN
            curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($chOne);
//Check error
            if (curl_error($chOne)) {
                echo 'error:' . curl_error($chOne);
            } else {
                $result_ = json_decode($result, true);
                echo "status : " . $result_['status'];
                echo "message : " . $result_['message'];
            }
//Close connect
            curl_close($chOne);

            var_dump($photo_line);
            //var_dump($photo_line1);
            //var_dump($photo_line2);
            //var_dump($photo_path);
            //echo Yii::getAlias('@webroot').'/images/programmerthailand_social.jpg';
        } else {
            if ($last_thread->last_id != $thread->id) {
                $last_thread_photo->ref = $thread->ref;
                $message = $thread->risk_summary;
                //$message = $thread->risk_summary . ' ' . Url::to('http://localhost/rm/frontend/web/index.php?r=riskmed/view&id=' . $thread->id);
                //$message = $last_thread_photo->risk_summary . ' ' .Gallery::widget(['items' => $last_thread_photo->getThumbnails($last_thread_photo->ref, $last_thread_photo->risk_review)]);
                //$message = $thread->risk_summary;
                $res = $this->notify_message($message);
                $last_thread->last_id = $thread->id;
                $last_thread->save();
            }
        }
    }

    public function notify_message($message) {
        $line_api = 'https://notify-api.line.me/api/notify';
        //$line_token = 'I4EJSmz7IKjcxHLfWZ3VgQZbLKs4uF6PwOAQoiNoqKJ';
        $line_token = '3dV1BSWIrbUdK0ZFqPrfyRiru60dmIJtm0bRmFbZhF1';
        //$queryData = array('imageFile' => '@' . Yii::getAlias('@webroot') . '/riskmed/dr2jTKhT5bhOlnUiSw0nrZ/b5b042132115b2deb8b3f50d6ebf8c51.jpg');
        $queryData = array('message' => $message);
        $queryData = http_build_query($queryData, '', '&');
        $headerOptions = array('http' => array('method' => 'POST', 'header' => "Content-Type: application/x-www-form-urlencoded\r\n" . "Authorization: Bearer " . $line_token . "\r\n" . "Content-Length: " . strlen($queryData) . "\r\n", 'content' => $queryData));
        $context = stream_context_create($headerOptions);
        $result = file_get_contents($line_api, FALSE, $context);
        $res = json_decode($result);
        return $res;
    }

}
