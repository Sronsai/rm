<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\helpers\Html;
use common\models\MyActiveRecord;

class Risk extends ActiveRecord {

    public $often;

    const UPLOAD_FOLDER = 'risks';
    const STATUS_YES_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 2;
    const OFTEN_NOLMAL = 1;
    const OFTEN_ABNOLMAL = 2;

    public static function itemsAlias($key) {

        $items = [
            'status_id' => [
                self::STATUS_YES_ACTIVE => 'ต้องทบทวน',
                self::STATUS_NOT_ACTIVE => 'ทบทวนแล้ว'
            ],
            'often' => [
                self::OFTEN_NOLMAL => 'ปกติ',
                self::OFTEN_ABNOLMAL => 'เกิดขึ้นประจำ'
            ],
        ];
        return ArrayHelper::getValue($items, $key, []);
        //return array_key_exists($key, $items) ? $items[$key] : [];
    }

    public static function itemsAlias2($key) {

        $items = [
            'type_clinic_id' => [
                self::STATUS_YES_ACTIVE => 'Clinic',
                self::STATUS_NOT_ACTIVE => 'Non Clinic'
            ]
        ];
        return ArrayHelper::getValue($items, $key, []);
        //return array_key_exists($key, $items) ? $items[$key] : [];
    }

    public function riskToArray() {
        return $this->often = explode(',', $this->often);
    }

    public function getItemStatus() {          //  สร้าง function เพื่อให้สามารถเรียกใช้งาน array item
        return self::itemsAlias('status_id');
    }

    public function getItemOften() {          //  สร้าง function เพื่อให้สามารถเรียกใช้งาน array item
        return self::itemsAlias('often');
    }

    public function getItemTypeClinic() {          //  สร้าง function เพื่อให้สามารถเรียกใช้งาน array item
        return self::itemsAlias2('type_clinic_id');
    }

    public function getStatusName() {        // Virtual Attribute เอาไว้แสดงข้อมูลใน Gridview 
        return ArrayHelper::getValue($this->getItemStatus(), $this->status_id);
    }

    public function getItemRiskOften() {
        return self::itemsAlias('often');
    }

    public function getOftenName() {
        return ArrayHelper::getValue($this->getItemRiskOften(), $this->often);
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
            [['person_id', 'location_riks_id', 'location_report_id', 'location_connection_id', 'risk_date', 'risk_report', 'type_id', 'sub_type_id', 'level_id', 'status_id', 'type_clinic_id'], 'required'],
            [['person_id', 'location_riks_id', 'location_report_id', 'type_id', 'sub_type_id', 'level_id', 'clear_id', 'system_id', 'status_id', 'type_clinic_id', 'often'], 'integer'],
            [['pname', 'risk_summary', 'risk_review', 'join_status'], 'string'],
            [['risk_date', 'risk_report'], 'safe'],
            [['ref'], 'string', 'max' => 50],
            [['hn'], 'string', 'max' => 45],
            [['risk_summary'], 'string', 'max' => 4500],
            //[['status_id'], 'string', 'max' => 150],
            [['fname', 'lname', 'often_blog'], 'string', 'max' => 100],
            [['docs'], 'file', 'maxFiles' => 5, /* 'skipOnEmpty' => true, 'extensions' => 'rar,pdf,doc,docx,xls,xlsx' */],
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
            'location_riks_id' => 'หน่วยงานที่เกิดเหตุ',
            'location_report_id' => 'หน่วยงานที่รายงาน',
            'location_connection_id' => 'หน่วยงานที่เกี่ยวข้อง',
            'risk_date' => 'วันที่เกิดเหตุ/เวลา',
            'risk_report' => 'วันที่รายงาน/เวลา',
            'risk_summary' => 'สรุปเหตุการณ์  ',
            'type_id' => 'ประเภทความเสี่ยง',
            'type_clinic_id' => 'ประเภทคลินิค',
            'sub_type_id' => 'ประเภทความเสี่ยงย่อย',
            'level_id' => 'ระดับ',
            'clear_id' => 'สาเหตุที่ชัดเจน',
            'system_id' => 'สาเหตุเชิงระบบ',
            'status_id' => Yii::t('app', 'การทบทวน'),
            //'status_id' => 'การทบทวน',
            'risk_review' => 'สรุปการทบทวน/แนวทาง',
            'docs' => 'ไฟล์เอกสารที่ทบทวน',
            'join_status' => 'ผู้ร่วมทบทวน',
            'often' => 'ความถี่ในการเกิดอุบัติการณ์',
            'often_blog' => 'ระบุจำนวน / ครั้ง   (***ใส่แค่จำนวนตัวเลขเท่านั้น)',
                //'globalSearch' => 'ค้นหาแบบระเอียด',
        ];
    }

    public function sendEmail($email) {
        return Yii::$app->mailer->compose()
                        ->setTo($email)
                        ->setFrom([$this->email => $this->name])
                        ->setSubject($this->risk_summary)
                        //->setTextBody($this->risk_summary)
                        ->send();
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
    public function getTypeClinic() {
        return $this->hasOne(TypeClinic::className(), ['id' => 'type_clinic_id']);
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

    public static function getUploadPath() {
        return Yii::getAlias('@webroot') . '/' . self::UPLOAD_FOLDER . '/';
    }

    public static function getUploadUrl() {
        return Url::base(true) . '/' . self::UPLOAD_FOLDER . '/';
    }

    public function getThumbnails($ref, $risk_review) {
        $uploadFiles = Uploads::find()->where(['ref' => $ref])->all();
        $preview = [];
        foreach ($uploadFiles as $file) {
            $preview[] = [
                'url' => self::getUploadUrl(true) . $ref . '/' . $file->real_filename,
                'src' => self::getUploadUrl(true) . $ref . '/thumbnail/' . $file->real_filename,
                'options' => ['title' => $risk_review]
            ];
        }
        return $preview;
    }

    public function getThumbnailsline($ref, $risk_review) {
        $uploadFiles = Uploads::find()->where(['ref' => $ref])->all();
        $preview = [];
        foreach ($uploadFiles as $file) {
            $preview[] = [
                'url' => self::getUploadUrl(true) . $ref . '/' . $file->real_filename,
                'src' => self::getUploadUrl(true) . $ref . '/' . $file->real_filename,
                'options' => ['title' => $risk_review]
            ];
            return $preview;
        }
    }

    public function initialPreview($data, $field, $type = 'file') {
        $initial = [];
        $files = Json::decode($data);
        if (is_array($files)) {
            foreach ($files as $key => $value) {
                if ($type == 'file') {
                    $initial[] = "<div class='file-preview-other'><h2><i class='glyphicon glyphicon-file'></i></h2></div>";
                } elseif ($type == 'config') {
                    $initial[] = [
                        'caption' => $value,
                        'width' => '120px',
                        'url' => Url::to(['/risk/deletefile', 'id' => $this->id, 'fileName' => $key, 'field' => $field]),
                        'key' => $key
                    ];
                } else {
                    $initial[] = Html::img(self::getUploadUrl() . $this->ref . '/' . $value, ['class' => 'file-preview-image', 'alt' => $model->file_name, 'title' => $model->file_name]);
                }
            }
        }
        return $initial;
    }

    public function listDownloadFiles($type) {
        $docs_file = '';
        if (in_array($type, ['docs'])) {

            $data = $type === 'docs' ? $this->docs : $this->covenant;
            $files = Json::decode($data);
            if (is_array($files)) {
                $docs_file = '<ul>';
                foreach ($files as $key => $value) {
                    $docs_file .= '<li>' . Html::a($value, ['/risk/download', 'id' => $this->id, 'file' => $key, 'file_name' => $value]) . '</li>';
                }
                $docs_file .='</ul>';
            }
        }

        return $docs_file;
    }

}

/*class Datetimetest extends MyActiveRecord {

    public static function tableName() {
        return 'datetimetest';
    }

    public function rules() {
        return [
            [['datetime1', 'datetime2'], 'required'],
            [['datetime1', 'datetime2'], 'safe'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'datetime1' => 'Datetime1',
            'datetime2' => 'Datetime2',
        ];
    }

    public function attributeHints() {
        return [
            'datetime1' => 'ตัวอยาง 13/05/2559 01:20:30',
            'datetime2' => 'ตัวอย่าง 13/05/2559 01:20:30',
        ];
    }

}*/
