<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

class Risk extends ActiveRecord {

    const STATUS_YES_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 2;

    public static function itemsAlias($key) {

        $items = [
            'status_id' => [
                self::STATUS_YES_ACTIVE => 'ต้องทบทวน',
                self::STATUS_NOT_ACTIVE => 'ทบทวนแล้ว'
            ]
        ];
        return ArrayHelper::getValue($items, $key, []);
        //return array_key_exists($key, $items) ? $items[$key] : [];
    }

    public function getItemStatus() {          //  สร้าง function เพื่อให้สามารถเรียกใช้งาน array item
        return self::itemsAlias('status_id');
    }

    public function getStatusName() {        //ดึงค่า label ออกมาแสดงเป็นข้อความให้เรา
        return ArrayHelper::getValue($this->getItemStatus(), $this->status_id);
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'risk';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['person_id', 'location_riks_id', 'location_report_id', 'location_connection_id', 'risk_date', 'risk_report', 'risk_summary', 'type_id', 'sub_type_id', 'level_id', 'status_id'], 'required'],
            [['person_id', 'location_riks_id', 'location_report_id', 'type_id', 'sub_type_id', 'level_id', 'clear_id', 'system_id', 'status_id'], 'integer'],
            [['pname', 'risk_summary', 'risk_review',], 'string'],
            [['risk_date', 'risk_report'], 'safe'],
            [['hn'], 'string', 'max' => 45],
            [['status_id'], 'string', 'max' => 150],
            [['fname', 'lname'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'person_id' => 'เหตุการณ์เกิดกับ',
            'hn' => 'HN',
            'pname' => 'คำนำหน้า',
            'fname' => 'ชื่อ',
            'lname' => 'นามสกุล',
            'location_riks_id' => 'หน่วยงานต้นเหตุ',
            'location_report_id' => 'หน่วยงานที่รายงาน',
            'location_connection_id' => 'หน่วยงานที่เกี่ยวข้อง',
            'risk_date' => 'วันที่เกิดเหตุ',
            'risk_report' => 'วันที่รายงาน',
            'risk_summary' => 'สรุปเหตุการณ์ / การแก้ไขเบื้องต้น',
            'type_id' => 'ประเภทความเสี่ยง',
            'sub_type_id' => 'ประเภทความเสี่ยงย่อย',
            'level_id' => 'ระดับความรุนแรง',
            'clear_id' => 'สาเหตุที่ชัดเจน',
            'system_id' => 'สาเหตุเชิงระบบ',
            'status_id' => Yii::t('app', 'การทบทวน'),
            //'status_id' => 'การทบทวน',
            'risk_review' => 'สรุปการทบทวน',
            'globalSearch' => '',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClear() {
        return $this->hasOne(Clear::className(), ['id' => 'clear_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel() {
        return $this->hasOne(Level::className(), ['id' => 'level_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationConnection() {
        return $this->hasOne(LocationConnection::className(), ['id' => 'location_connection_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationReport() {
        return $this->hasOne(LocationReport::className(), ['id' => 'location_report_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationRiks() {
        return $this->hasOne(LocationRiks::className(), ['id' => 'location_riks_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson() {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus() {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubType() {
        return $this->hasOne(SubType::className(), ['id' => 'sub_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystem() {
        return $this->hasOne(System::className(), ['id' => 'system_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType() {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRiskHasReviews() {
        return $this->hasMany(RiskHasReview::className(), ['risk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRiskHasReview1s() {
        return $this->hasMany(RiskHasReview1::className(), ['risk_id' => 'id']);
    }
    
    public static function find() {
        return new RiskQuery(get_called_class());
    }

}
