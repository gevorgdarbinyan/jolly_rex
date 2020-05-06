<?php

namespace frontend\controllers\profile;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use common\models\User;
use common\models\UserPhotos;
use yii\helpers\Html;
use yii\web\UploadedFile;

class EntertainerAjaxController extends Controller {

    public $enableCsrfValidation = false;

    public function beforeAction($action) {

        if (parent::beforeAction($action)) {

            Yii::$app->getResponse()->format = Response::FORMAT_JSON;
            return true;
        }
    }
    
    public function actionLoadChangePasswordTemplate() {
        if (Yii::$app->request->isAjax && Yii::$app->user->identity) {
            $str = '';
            $str .= $this->renderAjax('/user/entertainer/_change_password_template', []);
            
            return ['success' => true, 'html' => $str];
        }
    }
    
    public function actionLoadEmailTemplate() {
        if (Yii::$app->request->isAjax && Yii::$app->user->identity) {
            $str = '';
            $str .= $this->renderAjax('/user/entertainer/_change_email_template', []);
            
            return ['success' => true, 'html' => $str];
        }
    }
    
    public function actionLoadPersonalInfoTemplate() {
        if (Yii::$app->request->isAjax && Yii::$app->user->identity) {
            $userTypeData = Yii::$app->Helper->getUserUserTypesData(Yii::$app->user->identity->id);
            $userModelNamespace = '\common\models\\' . str_replace(' ', '', $userTypeData['user_type_name']);
            $userData = $userModelNamespace::findOne(['user_id' => Yii::$app->user->identity->id]);
            
            $userPhoto = UserPhotos::find()
                    ->where(['user_id' => Yii::$app->user->identity->id, 'type' => 'main'])
                    ->one();
            
            $str = '';
            $str .= $this->renderAjax('/user/entertainer/_change_personal_info_template', [
                'userData' => $userData,
                'userPhoto' => $userPhoto
                    ]);
            
            return ['success' => true, 'html' => $str];
        }
    }
    
    public function actionChangeUserPassword() {
        if (Yii::$app->request->isAjax && Yii::$app->user->identity) {
            $existingPassword = Yii::$app->request->post('existing_password');
            $newPassword = Yii::$app->request->post('new_password');
            $repeatNewPassword = Yii::$app->request->post('repeat_new_password');
            
            if ($existingPassword && $newPassword && $repeatNewPassword) {
                $userData = User::findOne(Yii::$app->user->identity->id);
                
                if (md5($existingPassword) == $userData['password']) {
                    if (($newPassword != $existingPassword) && ($newPassword == $repeatNewPassword)) {
                        $updateResult = Yii::$app->db->createCommand()->update('tbl_user', ['password' => md5($newPassword)], 'id = ' . Yii::$app->user->identity->id)->execute();
                        if ($updateResult) {
                            return ['success' => true];
                        }
                    } elseif ($newPassword == $existingPassword) {
                        return ['success' => false, 'reason' => 'same_password'];
                    } elseif ($newPassword != $repeatNewPassword) {
                        return ['success' => false, 'reason' => 'repeat_password_missmatch'];
                    }
                } else {
                    return ['success' => false, 'reason' => 'incorrect_existing_password'];
                }
            }
            
        }
    }
    
    public function actionChangeUserEmail() {
        if (Yii::$app->request->isAjax && Yii::$app->user->identity) {
            $newEmail = Yii::$app->request->post('new_email');
            $repeatNewEmail = Yii::$app->request->post('repeat_new_email');
            
            if ($newEmail == $repeatNewEmail) {
                
                $updateResult = Yii::$app->db->createCommand()->update('tbl_user', ['email' => $newEmail], 'id = ' . Yii::$app->user->identity->id)->execute();
                if ($updateResult) {
                    return ['success' => true];
                }
                
            }
            
        }
    }

    public function actionUpdatePersonalInfo() {
        if (Yii::$app->request->isAjax && Yii::$app->user->identity) {
            $name = Yii::$app->request->post('name');
            $firstName = Yii::$app->request->post('first_name');
            $lastName = Yii::$app->request->post('last_name');
            $supportInstantBooking = Yii::$app->request->post('support_instant_booking');
            $shortDescription = Yii::$app->request->post('short_description');
            $description = Yii::$app->request->post('description');
            $address = Yii::$app->request->post('address');
            $phoneNumber = Yii::$app->request->post('phone_number');
            $video = Yii::$app->request->post('video');
            
            $userTypeData = Yii::$app->Helper->getUserUserTypesData(Yii::$app->user->identity->id);
            $userModelNamespace = '\common\models\\' . str_replace(' ', '', $userTypeData['user_type_name']);
            $userTableName = $userModelNamespace::tableName();
            
            $updateResult = Yii::$app->db->createCommand()->update($userTableName,
                    [
                        'name' => $name,
                        'first_name' => $firstName,
                        'last_name' => $lastName,
                        'support_instant_booking' => $supportInstantBooking,
                        'short_description' => $shortDescription,
                        'description' => $description,
                        'address' => $address,
                        'phone_number' => $phoneNumber,
                        'video' => $video
                    ],
                    'user_id = ' . Yii::$app->user->identity->id)->execute();
                if ($updateResult) {
                    return ['success' => true];
                }
        }
    }

}
