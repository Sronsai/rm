<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "disease".
 *
 * @property integer $id
 * @property string $disease_name
 *
 * @property Risk[] $risks
 */
class Disease extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'disease';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['disease_name'], 'required'],
            [['disease_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'disease_name' => 'การป้องกันการติดเชื้อใน รพ.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRisks()
    {
        return $this->hasMany(Risk::className(), ['disease_id' => 'id']);
    }
}
