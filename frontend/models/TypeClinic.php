<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "type_clinic".
 *
 * @property integer $id
 * @property string $clinic_name
 */
class TypeClinic extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'type_clinic';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['clinic_name', 'required'],
            [['id'], 'integer'],
            [['clinic_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'clinic_name' => 'Clinic Name',
        ];
    }

    public function getRisks() {
        return $this->hasMany(Risk::className(), ['type_clinic_id' => 'id']);
    }

}
