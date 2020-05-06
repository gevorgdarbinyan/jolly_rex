<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\User;
use common\models\EntertainerSearch;
use common\models\UserSearch;
use common\models\UserTypes;
use common\models\entertainer\EntertainerBusySchedule;

/**
 * Site controller
 */
class SiteController extends Controller {

    public $userTypes = [
        1 => 'Customer',
        2 => 'Entertainer',
        3 => 'Venue Provider',
        4 => 'Party Product Provider',
        5 => 'Food Provider',
        6 => 'Sys Admin'
    ];

    /**
     * {@inheritdoc}
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
//                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {

        if (Yii::$app->user->identity) {
            $userSearchModel = new UserSearch();
            $dataProvider = $userSearchModel->searchForHomepage(Yii::$app->request->queryParams);

            $userTypeData = UserTypes::find()->where(['not in', 'name', ['Customer', 'Sys Admin']])->all();
            $userData = Yii::$app->Helper->getUserUserTypesData(Yii::$app->user->identity->id);
            $userType = str_replace(' ', '', $userData['user_type_name']);
            $namespace = '\frontend\components\\' . $userType . 'Widget';
            $userTypeWidget = $namespace::widget([
                        'content' => '',
                        'userData' => Yii::$app->user->identity,
                        'userTypeData' => $userTypeData,
                        'userSearchModel' => $userSearchModel,
                        'dataProvider' => $dataProvider
            ]);

            $busyScheduleObj = EntertainerBusySchedule::find()->select('busy_date')->where(['entertainer_id'=>Yii::$app->user->identity->id, 'busy_start_time'=>null, 'busy_end_time'=>null])->all();
            $busyDays = json_encode(array_map(function($item){
                return $item['busy_date'];
            }, $busyScheduleObj));

            return  $this->render('index', [
                    'userTypeWidget' => $userTypeWidget,
                    'userData' => $userData,
                    'busyDays'=>$busyDays,
                    'userType' => $userType
            ]);
        } else {
            return $this->render('index');
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
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
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    public function actionUserSettings() {
        if (Yii::$app->user->identity) {
            $userID = Yii::$app->user->identity->id;
            $userDataModel = User::findOne($userID);
            $userType = $this->userTypes[Yii::$app->user->identity->user_type_id];

            if ($userDataModel->load(Yii::$app->request->post())) {
                $userDataModel->save();
                //\yii\helpers\VarDumper::dump($userDataModel->save(), 10, true);die;
//                return $this->render('user-settings', [
//                            'userDataModel' => $userDataModel,
//                            'userType' => $userType
//                ]);
            }

            return $this->render('user-settings', [
                        'userDataModel' => $userDataModel,
                        'userType' => $userType
            ]);
        }
    }
    
    public function actionTestTemplate() {
        return $this->render('/orders/_basket_full_template', []);
    }

}
