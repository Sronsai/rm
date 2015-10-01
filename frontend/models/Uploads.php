<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "uploads".
 *
 * @property integer $upload_id
 * @property string $ref
 * @property string $file_name
 * @property string $real_filename
 */
class Uploads extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'uploads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ref'], 'string', 'max' => 50],
            [['file_name', 'real_filename'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'upload_id' => 'Upload ID',
            'ref' => 'Ref',
            'file_name' => 'ชื่อไฟล์',
            'real_filename' => 'ชื่อไฟล์จริง',
        ];
    }
}
