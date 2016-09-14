<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "station".
 *
 * @property string $station_id
 * @property string $station_name
 */
class Station extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'station';
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
            [['station_id', 'station_name'], 'required'],
            [['station_id'], 'string', 'max' => 5],
            [['station_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'station_id' => 'Station ID',
            'station_name' => 'Station Name',
        ];
    }
}
