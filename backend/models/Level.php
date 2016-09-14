<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "level".
 *
 * @property integer $id
 * @property string $level_name
 * @property string $level_description
 *
 * @property Risk[] $risks
 */
class Level extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level_name', 'level_description'], 'required'],
            [['level_name'], 'string', 'max' => 45],
            [['level_description'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'level_name' => 'ระดับความรุนแรง',
            'level_description' => 'รายละเอียด',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRisks()
    {
        return $this->hasMany(Risk::className(), ['level_id' => 'id']);
    }
}
