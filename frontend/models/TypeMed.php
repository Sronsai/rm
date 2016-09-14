<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "type_med".
 *
 * @property integer $id
 * @property string $type_name
 */
class TypeMed extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type_med';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_name'], 'required'],
            [['type_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_name' => 'ประเภทความเสี่ยง',
        ];
    }

     public function getRiskMed()
    {
        return $this->hasMany(RiskMed::className(), ['type_med_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubMedTypes()
    {
        return $this->hasMany(SubMedType::className(), ['sub_med_type_id' => 'id']);
    }
}
