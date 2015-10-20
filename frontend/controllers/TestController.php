<?php

namespace frontend\controllers;

use yii\web\Controller;

/**
 * Description of TestController
 *
 * @author Danai
 */
class TestController extends controller{
    
    public function actionTest($fname = NULL,$lname = NULL){
      
        return $this->render('test1',[
            'fname' => $fname,
            'lname' => $lname
        ]);
    }
}
