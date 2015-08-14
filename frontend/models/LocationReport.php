<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "location_report".
 *
 * @property integer $id
 * @property string $location_name
 *
 * @property Risk[] $risks
 */
class LocationReport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location_report';
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
            'location_name' => 'หน่วยงานที่รายงาน',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRisks()
    {
        return $this->hasMany(Risk::className(), ['location_report_id' => 'id']);
    }
}
