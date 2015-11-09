<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            //'captcha' => [
            //    'class' => 'yii\captcha\CaptchaAction',
            //   'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            //],
        ];
    }

    public function actionIndex() {

        $sql = "SELECT r.location_riks_id,l.location_name,count(l.location_name) as total FROM rm.risk r
  INNER JOIN rm.location_riks l ON l.id = r.location_riks_id GROUP BY r.location_riks_id order by total desc limit 20";

        $rawData = Yii::$app->db->createCommand($sql)->queryAll();
        $main_data = [];
        foreach ($rawData as $data) {
            $main_data[] = [
                'name' => $data['location_name'],
                'y' => $data['total'] * 1,
                'drilldown' => $data['location_riks_id']
            ];
        }
        $main = json_encode($main_data);
        //echo $main;
        $sql = "SELECT r.location_riks_id,l.location_name,
                SUM(CASE WHEN r.level_id='1' THEN 1 ELSE 0 END)AS A,
                SUM(CASE WHEN r.level_id='2' THEN 1 ELSE 0 END)AS B,
                SUM(CASE WHEN r.level_id='3' THEN 1 ELSE 0 END)AS C,
                SUM(CASE WHEN r.level_id='4' THEN 1 ELSE 0 END)AS D,
                SUM(CASE WHEN r.level_id='5' THEN 1 ELSE 0 END)AS E,
                SUM(CASE WHEN r.level_id='6' THEN 1 ELSE 0 END)AS F,
                SUM(CASE WHEN r.level_id='7' THEN 1 ELSE 0 END)AS G,
                SUM(CASE WHEN r.level_id='8' THEN 1 ELSE 0 END)AS H,
                SUM(CASE WHEN r.level_id='9' THEN 1 ELSE 0 END)AS I
                FROM rm.risk r
                INNER JOIN rm.location_riks l ON l.id = r.location_riks_id
                GROUP BY r.location_riks_id";
        $rawData = Yii::$app->db->createCommand($sql)->queryAll();
        $sub_data = [];
        foreach ($rawData as $data) {
            $sub_data[] = [
                'id' => $data['location_riks_id'],
                'name' => $data['location_name'],
                'data' => [[
                'A', $data['A'] * 1], [
                        'B', $data['B'] * 1], [
                        'C', $data['C'] * 1], [
                        'D', $data['D'] * 1], [
                        'E', $data['E'] * 1], [
                        'F', $data['F'] * 1], [
                        'G', $data['G'] * 1], [
                        'H', $data['H'] * 1], [
                        'I', $data['I'] * 1]]
            ];
        }
        $sub = json_encode($sub_data);




        $sql_level = "SELECT l.level_e as level,count(l.level_name) as total FROM risk r
                      LEFT OUTER JOIN level l ON l.id = r.level_id
                      GROUP BY l.level_name ASC";

        $rawData_level = Yii::$app->db->createCommand($sql_level)->queryAll();

        $main_data_level = [];
        foreach ($rawData_level as $data_level) {
            $main_data_level[] = [
                'name' => $data_level['level'],
                'y' => $data_level['total'] * 1,
                    //'drilldown' => $data['location_riks_id']
            ];
        }
        $main_level = json_encode($main_data_level);




        return $this->render('index', [
                    'sql' => $sql,
                    'main' => $main,
                    'sub' => $sub,
                    'sql_level' => $sql_level,
                    'main_level' => $main_level,
        ]);
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        //return $this->goHome();
        return $this->redirect('?r=site/login');
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    public function actionAbout() {
        return $this->render('about');
    }

    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', [
                    'model' => $model,
        ]);
        //return $this->render('site/index');
    }

    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

}
