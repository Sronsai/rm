<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "status_description".
 *
 * @property integer $id
 * @property string $status_date
 * @property string $status_description
 * @property string $status_name
 * @property integer $status_active_id
 * @property integer $status_id
 *
 * @property Risk[] $risks
 * @property Status $status
 * @property StatusActive $statusActive
 */
class StatusDescription extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status_description';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_date', 'status_description', 'status_name', 'status_active_id'], 'required'],
            [['status_date'], 'safe'],
            [['status_description'], 'string'],
            [['status_active_id', 'status_id'], 'integer'],
            [['status_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status_date' => 'วันที่ทบทวน',
            'status_description' => 'รายละเอียดการทบทวน',
            'status_name' => 'ผู้ทบทวน',
            'status_active_id' => 'สถานะการทบทวน',
            'status_id' => 'Status ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRisks()
    {
        return $this->hasMany(Risk::className(), ['status_description_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusActive()
    {
        return $this->hasOne(StatusActive::className(), ['id' => 'status_active_id']);
    }
}
