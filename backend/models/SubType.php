<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sub_type".
 *
 * @property integer $id
 * @property integer $type_id
 * @property string $sub_type_name
 *
 * @property Risk[] $risks
 * @property Type $type
 */
class SubType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sub_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'sub_type_name'], 'required'],
            [['type_id'], 'integer'],
            [['sub_type_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'ประเภทความเสี่ยง',
            'sub_type_name' => 'ประเภทย่อย',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRisks()
    {
        return $this->hasMany(Risk::className(), ['sub_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }
}
