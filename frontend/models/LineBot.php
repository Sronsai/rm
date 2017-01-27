<?php

namespace frontend\models;

use Yii;

class LineBot extends \yii\db\ActiveRecord {

    public static function tableName() {
        return 'line_bot';
    }

    public function rules() {
        return [
            [['type'], 'required'],
            [['type'], 'string', 'max' => 100]
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'type' => '...',
            'last_id' => '...123',
        ];
    }

    public function getRisks() {
        return $this->hasMany(Risk::className(), ['id' => 'id']);
    }

}
