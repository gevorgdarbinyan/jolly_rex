<?php

namespace backend\controllers;

use Yii;
use common\models\food\FoodItems;
use common\models\food\FoodItemsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * FoodItemsController implements the CRUD actions for FoodItems model.
 */
class FoodItemsController extends Controller
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
     * Creates a new FoodItems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $foodID = Yii::$app->request->get('food_id');
        $model = new FoodItems();
        $model->food_id = $foodID;
        $searchModel = new FoodItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['food_id'=>$foodID]);

        if ($model->load(Yii::$app->request->post())) {
            $uploadPath = Yii::getAlias('@root').'/common/uploads/food/';
            if(!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777);
            }
            $foodUploadPath = $uploadPath.'/'. $model->food_id;
            $foodItemsUploadPath = $foodUploadPath.'/'. $model->id;
            if(!is_dir($foodUploadPath)) {
                mkdir($foodUploadPath, 0777);
            }

            if(!is_dir($foodItemsUploadPath)) {
                mkdir($foodItemsUploadPath, 0777);
            }

            $file = UploadedFile::getInstance($model, 'image');
            $filename = md5(date('Y-m-d H:i:s')) . '.' . $file->extension;
            $file->saveAs($foodItemsUploadPath .'/' .$filename);
            $model->image = $filename;
            $model->save();
            return $this->redirect(['create', 'food_id' => $model->food_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing FoodItems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $foodID = Yii::$app->request->get('food_id');
        $model = $this->findModel($id);
        $model->food_id = $foodID;
        $image = $model->image;
        $searchModel = new FoodItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['food_id'=>$foodID]);

        if ($model->load(Yii::$app->request->post())) {
            $uploadPath = Yii::getAlias('@root').'/common/uploads/food/';
            if(!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777);
            }
            $foodUploadPath = $uploadPath.'/'. $model->food_id;
            $foodItemsUploadPath = $foodUploadPath.'/'. $model->id;
            if(!is_dir($foodUploadPath)) {
                mkdir($foodUploadPath, 0777);
            }

            if(!is_dir($foodItemsUploadPath)) {
                mkdir($foodItemsUploadPath, 0777);
            }

            $file = UploadedFile::getInstance($model, 'image');
            if($file) {
                $filename = md5(date('Y-m-d H:i:s')) . '.' . $file->extension;
                $file->saveAs($foodItemsUploadPath .'/' .$filename);
                $image = $filename;
            }
            $model->image = $image;
            $model->save();
            return $this->redirect(['create', 'food_id' => $model->food_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing FoodItems model.
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
     * Finds the FoodItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FoodItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FoodItems::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
