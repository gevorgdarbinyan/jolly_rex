<?php

namespace backend\controllers;

use Yii;
use common\models\entertainer\EntertainerStaff;
use common\models\entertainer\EntertainerStaffSearch;
use common\models\User;
use common\models\Entertainer;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * EntertainerStaffController implements the CRUD actions for EntertainerStaff model.
 */
class EntertainerStaffController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Creates a new EntertainerStaff model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $entertainerID = Yii::$app->request->get('entertainer_id');
        $entertainerData = Entertainer::findOne($entertainerID);

        $model = new EntertainerStaff();
        $model->entertainer_id = $entertainerID;
        

        $searchModel = new EntertainerStaffSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['entertainer_id'=>$entertainerID]);

        if ($model->load(Yii::$app->request->post())) {
            $uploadPath = Yii::getAlias('@root').'/common/uploads/entertainer';
            if(!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777);
            }
            $uploadPathStaff = $uploadPath.'/staff';
            if(!is_dir($uploadPathStaff)) {
                mkdir($uploadPathStaff, 0777);
            }

            $userUploadPath = $uploadPathStaff.'/'. $model->entertainer_id;
            $userEntertainerUploadPath = $userUploadPath.'/'. $model->id;
            $userEntertainerMainPhotoPath = $userEntertainerUploadPath.'/main';
            if(!is_dir($userUploadPath)) {
                mkdir($userUploadPath, 0777);
            }

            if(!is_dir($userEntertainerUploadPath)) {
                mkdir($userEntertainerUploadPath, 0777);
            }

            if(!is_dir($userEntertainerMainPhotoPath)) {
                mkdir($userEntertainerMainPhotoPath, 0777);
            }

            $file = UploadedFile::getInstance($model, 'photo');
            $filename = md5(date('Y-m-d H:i:s')) . '.' . $file->extension;
            $file->saveAs($userEntertainerMainPhotoPath .'/' .$filename);
            $model->photo = $filename;

            $model->save();
            return $this->redirect(['create', 'entertainer_id' => $model->entertainer_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'userData' => $entertainerData,
        ]);
    }

    /**
     * Updates an existing EntertainerStaff model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $entertainerID = Yii::$app->request->get('entertainer_id');
        $model = $this->findModel($id);
        $model->entertainer_id = $entertainerID;
        $photo = $model->photo;

        $searchModel = new EntertainerStaffSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['entertainer_id'=>$entertainerID]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $uploadPath = Yii::getAlias('@root').'/common/uploads/entertainer';
            if(!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777);
            }
            $uploadPathStaff = $uploadPath.'/staff';
            if(!is_dir($uploadPathStaff)) {
                mkdir($uploadPathStaff, 0777);
            }

            $userUploadPath = $uploadPathStaff.'/'. $model->entertainer_id;
            $userEntertainerUploadPath = $userUploadPath.'/'. $model->id;
            $userEntertainerMainPhotoPath = $userEntertainerUploadPath.'/main';
            if(!is_dir($userUploadPath)) {
                mkdir($userUploadPath, 0777);
            }

            if(!is_dir($userEntertainerUploadPath)) {
                mkdir($userEntertainerUploadPath, 0777);
            }

            if(!is_dir($userEntertainerMainPhotoPath)) {
                mkdir($userEntertainerMainPhotoPath, 0777);
            }

            $file = UploadedFile::getInstance($model, 'photo');
            if($file){
                $filename = md5(date('Y-m-d H:i:s')) . '.' . $file->extension;
                $file->saveAs($userEntertainerMainPhotoPath .'/' .$filename);
                $photo = $filename;
            }
            $model->photo = $photo;
            $model->save();
            return $this->redirect(['create', 'entertainer_id' => $model->entertainer_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Deletes an existing EntertainerStaff model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EntertainerStaff model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EntertainerStaff the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EntertainerStaff::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
