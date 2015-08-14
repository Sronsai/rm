<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property integer $id
 * @property string $status_name
 *
 * @property StatusDescription[] $statusDescriptions
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status';
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
            'status_name' => 'ต้องติดตาม / ต้องทบทวน',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusDescriptions()
    {
        return $this->hasMany(StatusDescription::className(), ['status_id' => 'id']);
    }
}
