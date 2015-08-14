<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "maintenance".
 *
 * @property integer $id
 * @property string $maintenance_name
 *
 * @property Risk[] $risks
 */
class Maintenance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'maintenance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['maintenance_name'], 'required'],
            [['maintenance_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'maintenance_name' => 'การดูแลรักษา',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRisks()
    {
        return $this->hasMany(Risk::className(), ['maintenance_id' => 'id']);
    }
}
