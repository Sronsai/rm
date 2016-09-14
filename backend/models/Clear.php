<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "clear".
 *
 * @property integer $id
 * @property string $clear_name
 *
 * @property Risk[] $risks
 */
class Clear extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clear';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clear_name'], 'required'],
            [['clear_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clear_name' => 'สาเหตุที่ชัดแจ้ง',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRisks()
    {
        return $this->hasMany(Risk::className(), ['clear_id' => 'id']);
    }
}
