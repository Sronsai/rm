<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "status_active".
 *
 * @property integer $id
 * @property string $status_name
 *
 * @property StatusDescription[] $statusDescriptions
 */
class StatusActive extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status_active';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_name'], 'required'],
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
            'status_name' => 'สถานะการทบทวน',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusDescriptions()
    {
        return $this->hasMany(StatusDescription::className(), ['status_active_id' => 'id']);
    }
}
