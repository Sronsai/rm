<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use frontend\models\Status;

class Referout extends \yii\db\ActiveRecord {
    
    const STATUS_YES_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 2;

    public static function tableName() {
        return 'referout';
    }

    public static function getDb() {
        return Yii::$app->get('db_refer');
    }

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

    public function rules() {
        return [
            [['refer_no', 'refer_date'], 'required'],
            [['refer_date', 'expire_date', 'load_date', 'vst_date', 'save_date', 'app_date'], 'safe'],
            [['is_upload', 'is_download', 'is_receive'], 'integer'],
            [['memo', 'memodiag'], 'string'],
            [['refer_no', 'pname', 'ett_no', 'ett_mark'], 'string', 'max' => 20],
            [['refertype_id', 'station_id', 'moopart', 'hospmain', 'hospsub', 'typept_id', 'strength_id', 'refer_hospcode', 'cause_referout_id', 'loads_id', 'coordinate_id', 'is_consult'], 'string', 'max' => 5],
            [['refer_time', 'location_id', 'hn', 'fname', 'lname', 'Send_spclty_id', 'clinicgroup', 'clinicsub', 'forward_flag', 'from_hospcode', 'save_time', 'refer_no_his', 'level_acute'], 'string', 'max' => 50],
            [['cid'], 'string', 'max' => 13],
            [['age', 'load_time'], 'string', 'max' => 10],
            [['addrpart', 'pttype_id', 'pttypeno', 'doctor_id', 'doctor_name', 'station_name'], 'string', 'max' => 100],
            [['tmbpart', 'amppart', 'chwpart'], 'string', 'max' => 2],
            [['is_coordinate_doctor', 'is_coordinate_nurse', 'image1', 'image2', 'image3', 'image4', 'image5'], 'string', 'max' => 1],
            [['sex', 'is_coordinate_not', 'is_coordinate_no', 'is_dead_refer', 'is_dead_er', 'is_dead_ward'], 'string', 'max' => 45],
            [['drugallergy'], 'string', 'max' => 900],
            [['cc', 'user_save'], 'string', 'max' => 4500],
            [['vn', 'conscious', 'e', 'v', 'm', 'evm_total', 'pupil_right', 'pupil_left', 't', 'p', 'r', 'bp', 'spo2', 'father', 'mother', 'location_name'], 'string', 'max' => 150],
            [['pttype_name'], 'string', 'max' => 500],
            [['warfarin_note'], 'string', 'max' => 1500],
            [['sync_memo', 'cause_referout_etc'], 'string', 'max' => 2000],
            [['status_id'], 'string', 'max' => 150],
            [['refer_status'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels() {
        return [
            'refer_no' => 'เลขที่ส่งต่อ',
            'refertype_id' => 'ประเภทการส่งต่อ',
            'refer_date' => 'วันที่ส่งต่อ',
            'refer_time' => 'เวลา',
            'station_id' => 'Station ID',
            'location_id' => 'Location ID',
            'cid' => 'CID',
            'hn' => 'HN',
            'pname' => 'คำนำหน้า',
            'fname' => 'ชื่อ',
            'lname' => 'นามสกุล',
            'age' => 'อายุ',
            'addrpart' => 'ที่อยู่',
            'moopart' => 'หมู่',
            'tmbpart' => 'ตำบล',
            'amppart' => 'อำเภอ',
            'chwpart' => 'จังหวัด',
            'pttype_id' => 'สิทธิ',
            'pttypeno' => 'Pttypeno',
            'hospmain' => 'Hospmain',
            'hospsub' => 'Hospsub',
            'typept_id' => 'Trauma/Non',
            'strength_id' => 'ระดับ',
            'doctor_id' => 'Doctor ID',
            'refer_hospcode' => 'Refer Hospcode',
            'cause_referout_id' => 'เหตุผลการส่งต่อ',
            'expire_date' => 'Expire Date',
            'loads_id' => 'Loads ID',
            'is_coordinate_doctor' => 'Is Coordinate Doctor',
            'is_coordinate_nurse' => 'Is Coordinate Nurse',
            'coordinate_id' => 'Coordinate ID',
            'image1' => 'Image1',
            'is_upload' => 'Is Upload',
            'is_download' => 'Is Download',
            'is_receive' => 'Is Receive',
            'image2' => 'Image2',
            'image3' => 'Image3',
            'image4' => 'Image4',
            'image5' => 'Image5',
            'sex' => 'เพศ',
            'is_coordinate_not' => 'Is Coordinate Not',
            'is_coordinate_no' => 'Is Coordinate No',
            'is_dead_refer' => 'Dead Forward',
            'is_dead_er' => 'Dead ER',
            'is_dead_ward' => 'Dead Ward',
            'memo' => 'Memo',
            'memodiag' => 'โรค/อาการ',
            'drugallergy' => 'แพ้ยา',
            'doctor_name' => 'ชื่อแพทย์',
            'cc' => 'CC/PI',
            'user_save' => 'User Save',
            'vn' => 'Vn',
            'conscious' => 'Conscious',
            'e' => 'E',
            'v' => 'V',
            'm' => 'M',
            'evm_total' => 'Evm Total',
            'pupil_right' => 'Pupil Right',
            'pupil_left' => 'Pupil Left',
            't' => 'T',
            'p' => 'P',
            'r' => 'R',
            'bp' => 'Bp',
            'Send_spclty_id' => 'Send Spclty ID',
            'load_time' => 'Load Time',
            'spo2' => 'Spo2',
            'clinicgroup' => 'Clinicgroup',
            'clinicsub' => 'Clinicsub',
            'load_date' => 'Load Date',
            'vst_date' => 'Vst Date',
            'station_name' => 'Station Name',
            'father' => 'Father',
            'mother' => 'Mother',
            'location_name' => 'Location Name',
            'pttype_name' => 'Pttype Name',
            'forward_flag' => 'Forward Flag',
            'from_hospcode' => 'From Hospcode',
            'save_date' => 'Save Date',
            'save_time' => 'Save Time',
            'warfarin_note' => 'Warfarin Note',
            'app_date' => 'App Date',
            'ett_no' => 'Ett No',
            'ett_mark' => 'Ett Mark',
            'sync_memo' => 'Sync Memo',
            'refer_no_his' => 'Refer No His',
            'level_acute' => 'Level Acute',
            'cause_referout_etc' => 'Cause Referout Etc',
            'is_consult' => 'Is Consult',
            'status_id' => 'การทบทวน',
            'refer_status' => 'สรุปการทบทวนเคส Refer / แนวทาง'
        ];
    }

    public function getTypept() {
        return $this->hasOne(Typept::className(), ['typept_id' => 'typept_id']);
    }

    public function getStrength() {
        return $this->hasOne(Strength::className(), ['strength_id' => 'strength_id']);
    }

    public function getCausereferout() {
        return $this->hasOne(Causereferout::className(), ['cause_referout_id' => 'cause_referout_id']);
    }
    
    public function getStatus() {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

}
