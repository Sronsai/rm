<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "system".
 *
 * @property integer $id
 * @property string $system_name
 *
 * @property Risk[] $risks
 */
class System extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['system_name'], 'required'],
            [['system_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'system_name' => 'สาเหตุเชิงระบบ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRisks()
    {
        return $this->hasMany(Risk::className(), ['system_id' => 'id']);
    }
}
