<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "etc".
 *
 * @property integer $id
 * @property string $etc_name
 *
 * @property Risk[] $risks
 */
class Etc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'etc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['etc_name'], 'required'],
            [['etc_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'etc_name' => 'อื่นๆ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRisks()
    {
        return $this->hasMany(Risk::className(), ['etc_id' => 'id']);
    }
}
