<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "risk".
 *
 * @property integer $id
 * @property integer $person_id
 * @property string $hn
 * @property string $pname
 * @property string $fname
 * @property string $lname
 * @property integer $location_riks_id
 * @property integer $location_report_id
 * @property integer $location_connection_id
 * @property string $risk_date
 * @property string $risk_report
 * @property string $risk_summary
 * @property integer $type_id
 * @property integer $level_id
 * @property integer $clear_id
 * @property integer $system_id
 * @property integer $status_id
 *
 * @property Clear $clear
 * @property Level $level
 * @property LocationConnection $locationConnection
 * @property LocationReport $locationReport
 * @property LocationRiks $locationRiks
 * @property Person $person
 * @property Status $status
 * @property System $system
 * @property Type $type
 * @property RiskHasReview[] $riskHasReviews
 * @property RiskHasReview1[] $riskHasReview1s
 */
class Risk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'risk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'location_riks_id', 'location_report_id', 'location_connection_id', 'risk_date', 'risk_report', 'risk_summary', 'type_id', 'level_id', 'clear_id', 'system_id', 'status_id'], 'required'],
            [['person_id', 'location_riks_id', 'location_report_id', 'location_connection_id', 'type_id', 'level_id', 'clear_id', 'system_id', 'status_id'], 'integer'],
            [['pname', 'risk_summary'], 'string'],
            [['risk_date', 'risk_report'], 'safe'],
            [['hn'], 'string', 'max' => 45],
            [['fname', 'lname'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'person_id' => 'เหตุการณ์เกิดกับ',
            'hn' => 'HN',
            'pname' => 'คำนำหน้า',
            'fname' => 'ชื่อ',
            'lname' => 'นามสกุล',
            'location_riks_id' => 'สถานที่เกิดเหตุ',
            'location_report_id' => 'หน่วยงานที่รายงาน',
            'location_connection_id' => 'หน่วยงานที่เกี่ยวข้อง',
            'risk_date' => 'วันที่เกิดเหตุ',
            'risk_report' => 'วันที่รายงาน',
            'risk_summary' => 'สรุปเหตุการณ์',
            'type_id' => 'ประเภทความเสี่ยง',
            'level_id' => 'ระดับความรุนแรง',
            'clear_id' => 'สาเหตุที่ชัดแจ้ง',
            'system_id' => 'สาเหตุเชิงระบบ',
            'status_id' => 'ติดตาม / ทบทวน',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClear()
    {
        return $this->hasOne(Clear::className(), ['id' => 'clear_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(Level::className(), ['id' => 'level_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationConnection()
    {
        return $this->hasOne(LocationConnection::className(), ['id' => 'location_connection_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationReport()
    {
        return $this->hasOne(LocationReport::className(), ['id' => 'location_report_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationRiks()
    {
        return $this->hasOne(LocationRiks::className(), ['id' => 'location_riks_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystem()
    {
        return $this->hasOne(System::className(), ['id' => 'system_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRiskHasReviews()
    {
        return $this->hasMany(RiskHasReview::className(), ['risk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRiskHasReview1s()
    {
        return $this->hasMany(RiskHasReview1::className(), ['risk_id' => 'id']);
    }
}
