<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sub_med_type".
 *
 * @property integer $id
 * @property integer $type_med_id
 * @property string $sub_med_type_name
 *
 * @property Type $typeMed
 */
class SubMedType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sub_med_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_med_id', 'sub_med_type_name'], 'required'],
            [['type_med_id'], 'integer'],
            [['sub_med_type_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_med_id' => 'ประเภทความเสี่ยง',
            'sub_med_type_name' => 'ประเภทย่อย',
        ];
    }

    public function getRiskMed()
    {
        return $this->hasMany(RiskMed::className(), ['sub_med_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeMed()
    {
        return $this->hasOne(TypeMed::className(), ['id' => 'type_med_id']);
    }
}
