<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cause_referout".
 *
 * @property string $cause_referout_id
 * @property string $cause_referout_name
 */
class CauseReferout extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cause_referout';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_refer');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cause_referout_id', 'cause_referout_name'], 'required'],
            [['cause_referout_id'], 'string', 'max' => 5],
            [['cause_referout_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cause_referout_id' => 'Cause Referout ID',
            'cause_referout_name' => 'Cause Referout Name',
        ];
    }
}
