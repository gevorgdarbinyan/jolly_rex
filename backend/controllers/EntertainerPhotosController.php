<?php

namespace backend\controllers;

use Yii;
use common\models\entertainer\EntertainerPhotos;
use common\models\entertainer\EntertainerPhotosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * EntertainerPhotosController implements the CRUD actions for EntertainerPhotos model.
 */
class EntertainerPhotosController extends Controller
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
     * Creates a new EntertainerPhotos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $entertainerID = Yii::$app->request->get('entertainer_id');
        $model = new EntertainerPhotos();
        $model->entertainer_id = $entertainerID;
        $searchModel = new EntertainerPhotosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['entertainer_id'=>$entertainerID]);

        if ($model->load(Yii::$app->request->post())) {
            $type = $model->type;
            $uploadPath = Yii::getAlias('@root').'/common/uploads';
            $entertainerUploadPath = $uploadPath.'/entertainer';
            if(!is_dir($entertainerUploadPath)) {
                mkdir($entertainerUploadPath, 0777);
            }
            $entertainerUploadIDPath = $entertainerUploadPath.'/'. $entertainerID;
            $entertainerTypePhotoPath = $entertainerUploadIDPath.'/'.$type;
            if(!is_dir($entertainerUploadIDPath)) {
                mkdir($entertainerUploadIDPath, 0777);
            }
            if(!is_dir($entertainerTypePhotoPath)) {
                mkdir($entertainerTypePhotoPath, 0777);
            }
            $file = UploadedFile::getInstance($model, 'photo');
            if($file) {
                $filename = md5(date('Y-m-d H:i:s')) . '.' . $file->extension;
                $file->saveAs($entertainerTypePhotoPath .'/' .$filename);
                $model->photo = $filename;
            }
            $model->save();
            return $this->redirect(['create', 'entertainer_id' => $entertainerID]);
        }

        return $this->render('create', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing EntertainerPhotos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $entertainerID = Yii::$app->request->get('entertainer_id');
        $model = $this->findModel($id);
        $photo = $model->photo;
        $searchModel = new EntertainerPhotosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['entertainer_id'=>$entertainerID]);

        if ($model->load(Yii::$app->request->post())) {
            $type = $model->type;
            $uploadPath = Yii::getAlias('@root').'/common/uploads';
            $entertainerUploadPath = $uploadPath.'/entertainer';
            if(!is_dir($entertainerUploadPath)) {
                mkdir($entertainerUploadPath, 0777);
            }
            $entertainerUploadIDPath = $entertainerUploadPath.'/'. $entertainerID;
            $entertainerTypePhotoPath = $entertainerUploadIDPath.'/'.$type;
            if(!is_dir($entertainerUploadIDPath)) {
                mkdir($entertainerUploadIDPath, 0777);
            }
            if(!is_dir($entertainerTypePhotoPath)) {
                mkdir($entertainerTypePhotoPath, 0777);
            }
            $file = UploadedFile::getInstance($model, 'photo');
            if($file) {
                $filename = md5(date('Y-m-d H:i:s')) . '.' . $file->extension;
                $file->saveAs($entertainerTypePhotoPath .'/' .$filename);
                $photo = $filename;
            }
            $model->photo = $photo;
            $model->save();
            return $this->redirect(['create', 'entertainer_id' => $entertainerID]);
        }

        return $this->render('update', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Deletes an existing EntertainerPhotos model.
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
     * Finds the EntertainerPhotos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EntertainerPhotos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EntertainerPhotos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
