<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "status_description".
 *
 * @property integer $id
 * @property string $status
 * @property string $status_date
 * @property string $status_description
 * @property string $status_name
 * @property integer $status_active_id
 *
 * @property Risk[] $risks
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
            [['status', 'status_description'], 'string'],
            [['status_date', 'status_description', 'status_name', 'status_active_id'], 'required'],
            [['status_date'], 'safe'],
            [['status_active_id'], 'integer'],
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
            'status' => 'การติดตาม/ทบทวน',
            'status_date' => 'วันที่ทบทวน',
            'status_description' => 'รายละเอียดการทบทวน',
            'status_name' => 'ผู้ทบทวน',
            'status_active_id' => 'สถานะการทบทวน',
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
    public function getStatusActive()
    {
        return $this->hasOne(StatusActive::className(), ['id' => 'status_active_id']);
    }
}
