<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "publics".
 *
 * @property integer $id
 * @property string $public_name
 */
class Publics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['public_name'], 'required'],
            [['public_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'public_name' => 'ระบบสาธารณูปโภค',
        ];
    }
}
