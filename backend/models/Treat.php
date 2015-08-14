<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "treat".
 *
 * @property integer $id
 * @property string $treat_name
 *
 * @property Risk[] $risks
 */
class Treat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'treat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['treat_name'], 'required'],
            [['treat_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'treat_name' => 'ระบบข้อมูลการดูแลรักษา',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRisks()
    {
        return $this->hasMany(Risk::className(), ['treat_id' => 'id']);
    }
}
