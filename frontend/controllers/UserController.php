<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\UserPhotos;

/**
 * Site controller
 */
class UserController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
//                    [
//                        'actions' => ['signup'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                    [
//                        'actions' => ['logout'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
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
    
    public function actionProfile($id) {
        $this->layout = 'main-profile';
        if (Yii::$app->user->identity && $id) {
            $userTypeData = Yii::$app->Helper->getUserUserTypesData($id);
            $userModelNamespace = '\common\models\\' . str_replace(' ', '', $userTypeData['user_type_name']);
            $userData = $userModelNamespace::findOne(['user_id' => $id]);
            $userType = str_replace(' ', '', $userTypeData['user_type_name']) . 'Profile';
            $namespaceDetails = '\frontend\components\profile\\' . $userType . 'PersonalDetailsWidget';
            $userProfilePersonalDetailsWidget = $namespaceDetails::widget([
                        'content' => '',
                        'userData' => $userData,
            ]);
            $namespaceOrders = '\frontend\components\profile\\' . $userType . 'MyOrdersWidget';
            $userProfileMyOrdersWidget = $namespaceOrders::widget([
                        'content' => '',
                        'userData' => $userData,
            ]);

            $namespaceOrders = '\frontend\components\profile\\' . $userType . 'MyEnquiriesWidget';
            $userProfileMyEnquiriesWidget = $namespaceOrders::widget([
                        'content' => '',
                        'userData' => $userData,
            ]);
        }
        return $this->render('profile', [
            'userProfilePersonalDetailsWidget' => $userProfilePersonalDetailsWidget,
            'userProfileMyOrdersWidget' => $userProfileMyOrdersWidget,
            'userProfileMyEnquiriesWidget' => $userProfileMyEnquiriesWidget
        ]);
    }
    
    public function actionUploadUserPhoto() {
        if (Yii::$app->user->identity) {
            if ($_FILES['userPhoto']) {
                $userID = Yii::$app->user->identity->id;
                
                $uploadPath = Yii::getAlias('@root') . '/common/uploads/customer/' . $userID;
                if(!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                
                $file = UploadedFile::getInstanceByName('userPhoto');
                $filename = md5(date('Y-m-d H:i:s')) . '.' . $file->extension;
                $file->saveAs($uploadPath .'/' .$filename);
                
                $userPhotoData = UserPhotos::find()->where(['user_id' => $userID])->one();
                
                if (!$userPhotoData) {
                    $userPhotoModel = new UserPhotos();
                    
                    $userPhotoModel->setAttributes([
                        'user_id' => $userID,
                        'photo' => $filename,
                        'type' => 'main'
                    ]);
                    
                    $userPhotoModel->save();
                    
                } else {
                    Yii::$app->db->createCommand()->update('tbl_user_photos', ['photo' => $filename], 'user_id = ' . $userID . ' AND type = "main"')->execute();
                }
                
            }
        }
        
        return $this->redirect(Yii::$app->request->referrer);
    }

}
