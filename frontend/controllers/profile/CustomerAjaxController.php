<?php

namespace frontend\controllers\profile;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use common\models\User;
use common\models\UserPhotos;
use yii\helpers\Html;
use yii\web\UploadedFile;

class CustomerAjaxController extends Controller {

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
            $str .= $this->renderAjax('/user/customer/_change_password_template', []);
            
            return ['success' => true, 'html' => $str];
        }
    }
    
    public function actionLoadEmailTemplate() {
        if (Yii::$app->request->isAjax && Yii::$app->user->identity) {
            $str = '';
            $str .= $this->renderAjax('/user/customer/_change_email_template', []);
            
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
            $str .= $this->renderAjax('/user/customer/_change_personal_info_template', [
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
            $postalCode = Yii::$app->request->post('postal_code');
            $address = Yii::$app->request->post('address');
            $phoneNumber = Yii::$app->request->post('phone_number');
            
            $userTypeData = Yii::$app->Helper->getUserUserTypesData(Yii::$app->user->identity->id);
            $userModelNamespace = '\common\models\\' . str_replace(' ', '', $userTypeData['user_type_name']);
            $userTableName = $userModelNamespace::tableName();
            
            $updateResult = Yii::$app->db->createCommand()->update($userTableName,
                    [
                        'postal_code' => $postalCode,
                        'address' => $address,
                        'phone_number' => $phoneNumber
                    ],
                    'user_id = ' . Yii::$app->user->identity->id)->execute();
                if ($updateResult) {
                    return ['success' => true];
                }
        }
    }
    
    public function actionUpdateUserPhoto() {
        if (Yii::$app->request->isAjax && Yii::$app->user->identity) {
            $userID = Yii::$app->user->identity->id;
            $file = UploadedFile::getInstanceByName('customerPhoto');

            if ($file->extension == 'jpg' || $file->extension == 'jpeg' || $file->extension == 'png' || $file->extension == 'gif') {
                $uploadPath = Yii::getAlias('@root') . '/common/uploads/customer/' . $userID;
                if(!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                $filename = md5(date('Y-m-d H:i:s')) . '.' . $file->extension;
                $file->saveAs($uploadPath . '/' . $filename);
                
                $userPhotoData = UserPhotos::findOne(['user_id' => $userID, 'type' => 'main']);
                
                if ($userPhotoData) {
                    $userPhotoData->photo = $filename;
                    $userPhotoData->save();
                } else {
                    $userPhotoModel = new UserPhotos();
                    $userPhotoModel->setAttributes([
                        'user_id' => $userID,
                        'photo' => $filename,
                        'type' => 'main'
                    ]);
                    $userPhotoModel->save();
                }
                
//                Yii::$app->db->createCommand()
//                        ->update('users', ['img' => $filename], 'id=:id', ['id' => Yii::$app->session->get('User')['id']])
//                        ->execute();
                return ['success' => true, 'message' => 'Image successfully updated', 'image' => $filename];
            } else {
                return ['success' => false, 'message' => 'Chose .jpg, .jpeg, .png or .gif formats for image'];
            }
        }
    }

}
