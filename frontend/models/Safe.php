<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "safe".
 *
 * @property integer $id
 * @property string $safe_name
 *
 * @property Risk[] $risks
 */
class Safe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'safe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['safe_name'], 'required'],
            [['safe_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'safe_name' => 'ความปลอดภัย',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRisks()
    {
        return $this->hasMany(Risk::className(), ['safe_id' => 'id']);
    }
}
