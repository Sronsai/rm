<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Risk;
use frontend\models\RiskSearch;
use frontend\models\Uploads;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use common\models\User;
use yii\helpers\Url;
use yii\filters\AccessControl;
use common\components\AccessRule;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use kartik\mpdf\Pdf;

/**
 * RiskController implements the CRUD actions for Risk model.
 */
class RiskController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'view', 'delete'],
                'ruleConfig' => [
                    'class' => AccessRule::className()
                ],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'view'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_USER,
                            User::ROLE_MODERATOR,
                            User::ROLE_ADMIN
                        ]
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_MODERATOR,
                            User::ROLE_ADMIN
                        ]
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => [User::ROLE_ADMIN]
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Risk models.
     * @return mixed
     */
    public function actionIndex() {
        $model = new Risk();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model = new Risk(); //reset model
        }

        $searchModel = new RiskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model
        ]);
    }

    /**
     * Displays a single Risk model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {

        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionPdf($id) {
        
        $time = time();

        $content = $this->renderPartial('pdf', [
            'time' => $time,
            'model' => $this->findModel($id),
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            'marginTop' => 10,
            'marginLeft' => 15,
            'marginRight' => 15,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.css',
            // any css to be embedded if required
            'cssInline' => '
              body{
                font-family:"garuda", "sans-serif";
                font-size:14px;
              }
                    p{
                    font-size:10px;
                    line-height: 4px;
                    }
                    #wrapper{

                    width: 210.5mm;
                    height: 150mm;
                    margin: 0px;
                }
                #header{
                height: 25mm;
                }
                #header p{
                    margin-bottom: 0px;
                }
                .row1{
                height: 50%
                margin: 0px;
                }
                .row2{
                height: 50%
                margin: 0px;
                background-color: yellow;
                }


            ',
            // set mPDF properties on the fly
            'options' => [
                'title' => '',
            ],
            // call mPDF methods on the fly
            'methods' => [
            //'SetHeader' => ['รายละเอียดการประเมินปัญหาแรกรับ'],
            //'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    /**
     * Creates a new Risk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Risk();

        if ($model->load(Yii::$app->request->post())) {

            $this->Uploads(false);
            $this->CreateDir($model->ref);

            //$model->covenant = $this->uploadSingleFile($model);
            $model->docs = $this->uploadMultipleFile($model);

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
                //return $this->redirect(['index']);
            }
        } else {
            $model->ref = substr(Yii::$app->getSecurity()->generateRandomString(), 10);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);


        /* if ($model->load(Yii::$app->request->post()) && $model->save()) {
          //return $this->redirect(['view', 'id' => $model->id]);
          //Popup แสดงการบันทึกข้อมูลสำเร็จ
          Yii::$app->getSession()->setFlash('alert1', [
          'type' => 'success',
          'duration' => 3000,
          'icon' => 'fa fa-pencil',
          'title' => Yii::t('app', Html::encode('SAVE')),
          'message' => Yii::t('app', Html::encode(' บันทึกข้อมูลเสร็จเรียบร้อย')),
          'positonY' => 'top',
          'positonX' => 'right'
          ]);

          Yii::$app->getSession()->setFlash('alert2', [
          'type' => 'info',
          'duration' => 5000,
          'icon' => 'fa fa-thumbs-o-up',
          'title' => Yii::t('app', Html::encode('Thank You')),
          'message' => Yii::t('app', Html::encode(' ขอบคุณมากค่ะ..')),
          'positonY' => 'top',
          'positonX' => 'right'
          ]);

          return $this->redirect(['/site/index']);
          } else {
          return $this->render('create', [
          'model' => $model,
          ]);
          } */
    }

    /**
     * Updates an existing Risk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        list($initialPreview, $initialPreviewConfig) = $this->getInitialPreview($model->ref);
        //$tempCovenant = $model->covenant;
        $tempDocs = $model->docs;
        if ($model->load(Yii::$app->request->post())) {
            $this->Uploads(false);
            //$model->covenant = $this->uploadSingleFile($model, $tempCovenant);
            $model->docs = $this->uploadMultipleFile($model, $tempDocs);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
                //return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
                    'model' => $model,
                    'initialPreview' => $initialPreview,
                    'initialPreviewConfig' => $initialPreviewConfig
        ]);

        /* if ($model->load(Yii::$app->request->post()) && $model->save()) {
          //return $this->redirect(['view', 'id' => $model->id]);
          return $this->redirect(['/risk/index']);
          } else {
          return $this->render('update', [
          'model' => $model,
          ]);
          } */
    }

    /**
     * Deletes an existing Risk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        //remove upload file & data
        $this->removeUploadDir($model->ref);
        Uploads::deleteAll(['ref' => $model->ref]);

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Risk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Risk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Risk::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function uploadMultipleFile($model, $tempFile = null) {
        $files = [];
        $json = '';
        $tempFile = Json::decode($tempFile);
        $UploadedFiles = UploadedFile::getInstances($model, 'docs');
        if ($UploadedFiles !== null) {
            foreach ($UploadedFiles as $file) {
                try {
                    $oldFileName = $file->basename . '.' . $file->extension;
                    $newFileName = md5($file->basename . time()) . '.' . $file->extension;
                    $file->saveAs(Risk::UPLOAD_FOLDER . '/' . $model->ref . '/' . $newFileName);
                    $files[$newFileName] = $oldFileName;
                } catch (Exception $e) {
                    
                }
            }
            $json = json::encode(ArrayHelper::merge($tempFile, $files));
        } else {
            $json = $tempFile;
        }
        return $json;
    }

    private function CreateDir($folderName) {
        if ($folderName != NULL) {
            $basePath = Risk::getUploadPath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {
                BaseFileHelper::createDirectory($basePath . $folderName . '/thumbnail', 0777);
            }
        }
        return;
    }

    public function actionDownload($id, $file, $file_name) {
        $model = $this->findModel($id);
        if (!empty($model->ref)) {
            Yii::$app->response->sendFile($model->getUploadPath() . '/' . $model->ref . '/' . $file, $file_name);
        } else {
            $this->redirect(['/risk/view', 'id' => $id]);
        }
    }

    private function Uploads($isAjax = false) {
        if (Yii::$app->request->isPost) {
            $images = UploadedFile::getInstancesByName('upload_ajax');
            if ($images) {

                if ($isAjax === true) {
                    $ref = Yii::$app->request->post('ref');
                } else {
                    $Risk = Yii::$app->request->post('Risk');
                    $ref = $Risk['ref'];
                }

                $this->CreateDir($ref);

                foreach ($images as $file) {
                    $fileName = $file->baseName . '.' . $file->extension;
                    $realFileName = md5($file->baseName . time()) . '.' . $file->extension;
                    $savePath = Risk::UPLOAD_FOLDER . '/' . $ref . '/' . $realFileName;
                    if ($file->saveAs($savePath)) {

                        if ($this->isImage(Url::base(true) . '/' . $savePath)) {
                            $this->createThumbnail($ref, $realFileName);
                        }

                        $model = new Uploads;
                        $model->ref = $ref;
                        $model->file_name = $fileName;
                        $model->real_filename = $realFileName;
                        $model->save();

                        if ($isAjax === true) {
                            echo json_encode(['success' => 'true']);
                        }
                    } else {
                        if ($isAjax === true) {
                            echo json_encode(['success' => 'false', 'eror' => $file->error]);
                        }
                    }
                }
            }
        }
    }

    private function getInitialPreview($ref) {
        $datas = Uploads::find()->where(['ref' => $ref])->all();
        $initialPreview = [];
        $initialPreviewConfig = [];
        foreach ($datas as $key => $value) {
            array_push($initialPreview, $this->getTemplatePreview($value));
            array_push($initialPreviewConfig, [
                'caption' => $value->file_name,
                'width' => '120px',
                'url' => Url::to(['/risk/deletefile-ajax']),
                'key' => $value->upload_id
            ]);
        }
        return [$initialPreview, $initialPreviewConfig];
    }

    public function isImage($filePath) {
        return @is_array(getimagesize($filePath)) ? true : false;
    }

    private function getTemplatePreview(Uploads $model) {
        $filePath = Risk::getUploadUrl() . $model->ref . '/thumbnail/' . $model->real_filename;
        $isImage = $this->isImage($filePath);
        if ($isImage) {
            $file = Html::img($filePath, ['class' => 'file-preview-image', 'alt' => $model->file_name, 'title' => $model->file_name]);
        } else {
            $file = "<div class='file-preview-other'> " .
                    "<h2><i class='glyphicon glyphicon-file'></i></h2>" .
                    "</div>";
        }
        return $file;
    }

    private function createThumbnail($folderName, $fileName, $width = 250) {
        $uploadPath = risk::getUploadPath() . '/' . $folderName . '/';
        $file = $uploadPath . $fileName;
        $image = Yii::$app->image->load($file);
        $image->resize($width);
        $image->save($uploadPath . 'thumbnail/' . $fileName);
        return;
    }

    public function actionDeletefileAjax() {
        $model = Uploads::findOne(Yii::$app->request->post('key'));
        if ($model !== NULL) {
            $filename = Risk::getUploadPath() . $model->ref . '/' . $model->real_filename;
            $thumbnail = Risk::getUploadPath() . $model->ref . '/thumbnail/' . $model->real_filename;
            if ($model->delete()) {
                @unlink($filename);
                @unlink($thumbnail);
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        } else {
            echo json_encode(['success' => false]);
        }
    }

    private function removeUploadDir($dir) {
        BaseFileHelper::removeDirectory(Risk::getUploadPath() . $dir);
    }

    public function actionMpdfprint() {

        $order = \frontend\models\Risk::find()
                ->where("risk_date between '" . $model->start_date . " ' and ' " . $model->end_date . "'")
                ->all();

        $pdf = '_report1'; // file name

        return $this->renderPartial($pdf, [
                    'order' => $order
        ]);
    }

}
