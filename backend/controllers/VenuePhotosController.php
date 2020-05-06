<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\venue\VenuePhotos;
use common\models\venue\VenuePhotosSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * VenueOptionsController implements the CRUD actions for VenueOptions model.
 */
class VenuePhotosController extends Controller
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
     * Creates a new VenuePhotos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $venueID = Yii::$app->request->get('venue_id');
        $model = new VenuePhotos();
        $model->venue_id = $venueID;
        $searchModel = new VenuePhotosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['venue_id'=>$venueID]);

        if ($model->load(Yii::$app->request->post())) {
            $type = $model->type;
            $uploadPath = Yii::getAlias('@root').'/common/uploads';
            $venueUploadPath = $uploadPath.'/venue';
            if(!is_dir($venueUploadPath)) {
                mkdir($venueUploadPath, 0777);
            }
            $venueUploadIDPath = $venueUploadPath.'/'. $venueID;
            $venueTypePhotoPath = $venueUploadIDPath.'/'.$type;
            if(!is_dir($venueUploadIDPath)) {
                mkdir($venueUploadIDPath, 0777);
            }
            if(!is_dir($venueTypePhotoPath)) {
                mkdir($venueTypePhotoPath, 0777);
            }
            $file = UploadedFile::getInstance($model, 'photo');
            if($file) {
                $filename = md5(date('Y-m-d H:i:s')) . '.' . $file->extension;
                $file->saveAs($venueTypePhotoPath .'/' .$filename);
                $model->photo = $filename;
            }
            $model->save();
            return $this->redirect(['create', 'venue_id' => $venueID]);
        }

        return $this->render('create', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing VenuePhotos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $venueID = Yii::$app->request->get('venue_id');
        $model = $this->findModel($id);
        $photo = $model->photo;
        $searchModel = new VenuePhotosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['venue_id'=>$venueID]);

        if ($model->load(Yii::$app->request->post())) {
            $type = $model->type;
            $uploadPath = Yii::getAlias('@root').'/common/uploads';
            $venueUploadPath = $uploadPath.'/venue';
            if(!is_dir($venueUploadPath)) {
                mkdir($venueUploadPath, 0777);
            }
            $venueUploadIDPath = $venueUploadPath.'/'. $venueID;
            $venueTypePhotoPath = $venueUploadIDPath.'/'.$type;
            if(!is_dir($venueUploadIDPath)) {
                mkdir($venueUploadIDPath, 0777);
            }
            if(!is_dir($venueTypePhotoPath)) {
                mkdir($venueTypePhotoPath, 0777);
            }
            $file = UploadedFile::getInstance($model, 'photo');
            if($file) {
                $filename = md5(date('Y-m-d H:i:s')) . '.' . $file->extension;
                $file->saveAs($venueTypePhotoPath .'/' .$filename);
                $photo = $filename;
            }
            $model->photo = $photo;
            $model->save();
            return $this->redirect(['create', 'venue_id' => $venueID]);
        }

        return $this->render('update', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Finds the VenuePhotos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VenuePhotos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VenuePhotos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
