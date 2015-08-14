<?php

namespace backend\models;

use Yii;

class Site extends model {

    public function attributeLabels() {
        return [
            'username' => 'ชื่อผู้ใช้งาน',
            'password' => 'รหัสผ่าน',
        ];
    }

}
