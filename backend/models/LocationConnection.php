<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "location_connection".
 *
 * @property integer $id
 * @property string $location_name
 *
 * @property Risk[] $risks
 */
class LocationConnection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location_connection';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['location_name'], 'required'],
            [['location_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'location_name' => 'หน่วยงานเกี่ยวข้อง',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRisks()
    {
        return $this->hasMany(Risk::className(), ['location_connection_id' => 'id']);
    }
}
