<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\FoodItemPhotos;
use common\models\FoodItemPhotosSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * FoodOptionsController implements the CRUD actions for FoodOptions model.
 */
class FoodPhotosController extends Controller
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
     * Creates a new FoodPhotos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $foodID = Yii::$app->request->get('food_id');
        $foodItemID = Yii::$app->request->get('id');
        $model = new FoodItemPhotos();
        $searchModel = new FoodItemPhotosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['food_item_id' => $foodItemID]);

        if ($model->load(Yii::$app->request->post())) {
            $type = $model->type;
            $uploadPath = Yii::getAlias('@root') . '/common/uploads';
            $foodUploadPath = $uploadPath . '/food';
            if ($type) {
                /* TODO Delete All Main Photos */
                if(!is_dir($foodUploadPath)) {
                    mkdir($foodUploadPath, 0777);
                }
                $foodUploadIDPath = $foodUploadPath . '/' . $foodID . '/' . $foodItemID;
                $foodTypePhotoPath = $foodUploadIDPath . '/' . $type;
                if(!is_dir($foodUploadIDPath)) {
                    mkdir($foodUploadIDPath, 0777);
                }
                if(!is_dir($foodTypePhotoPath)) {
                    mkdir($foodTypePhotoPath, 0777);
                }
                $file = UploadedFile::getInstance($model, 'photo');
                if($file) {
                    $filename = md5(date('Y-m-d H:i:s')) . '.' . $file->extension;
                    $file->saveAs($foodTypePhotoPath .'/' .$filename);
                    $model->photo = $filename;
                }
                $model->food_item_id = $foodItemID;
                $model->save();
                if ($type == 'main') {
                    Yii::$app->db->createCommand()->update('tbl_food_items', ['image' => $filename], 'id = ' . $foodItemID)->execute();
                }
            }
            
            return $this->redirect(['create', 'food_id' => $foodID, 'id' => $foodItemID]);
        }

        return $this->render('create', [
            'foodID' => $foodID,
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing FoodPhotos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $foodID = Yii::$app->request->get('food_id');
        $model = $this->findModel($id);
        $photo = $model->photo;
        $searchModel = new FoodPhotosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['food_id'=>$foodID]);

        if ($model->load(Yii::$app->request->post())) {
            $type = $model->type;
            $uploadPath = Yii::getAlias('@root').'/common/uploads';
            $foodUploadPath = $uploadPath.'/food';
            if(!is_dir($foodUploadPath)) {
                mkdir($foodUploadPath, 0777);
            }
            $foodUploadIDPath = $foodUploadPath.'/'. $foodID;
            $foodTypePhotoPath = $foodUploadIDPath.'/'.$type;
            if(!is_dir($foodUploadIDPath)) {
                mkdir($foodUploadIDPath, 0777);
            }
            if(!is_dir($foodTypePhotoPath)) {
                mkdir($foodTypePhotoPath, 0777);
            }
            $file = UploadedFile::getInstance($model, 'photo');
            if($file) {
                $filename = md5(date('Y-m-d H:i:s')) . '.' . $file->extension;
                $file->saveAs($foodTypePhotoPath .'/' .$filename);
                $photo = $filename;
            }
            $model->photo = $photo;
            $model->save();
            return $this->redirect(['create', 'food_id' => $foodID]);
        }

        return $this->render('update', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

}
