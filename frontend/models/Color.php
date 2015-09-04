<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "color".
 *
 * @property integer $id
 * @property string $color
 * @property string $code_color
 */
class Color extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'color';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['color', 'code_color'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Color',
            'code_color' => 'Code Color',
        ];
    }
}
