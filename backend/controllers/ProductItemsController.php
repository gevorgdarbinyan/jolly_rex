<?php

namespace backend\controllers;

use Yii;
use common\models\product\ProductItems;
use common\models\product\ProductItemsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductItemsController implements the CRUD actions for ProductItems model.
 */
class ProductItemsController extends Controller
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
     * Creates a new ProductItems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $productID = Yii::$app->request->get('product_id');
        $model = new ProductItems();
        $model->product_id = $productID;
        $searchModel = new ProductItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['product_id'=>$productID]);

        if ($model->load(Yii::$app->request->post())) {
            $uploadPath = Yii::getAlias('@root').'/common/uploads/product/';
            if(!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777);
            }
            $productUploadPath = $uploadPath.'/'. $model->product_id;
            $productItemsUploadPath = $productUploadPath.'/'. $model->id;
            if(!is_dir($productUploadPath)) {
                mkdir($productUploadPath, 0777);
            }

            if(!is_dir($productItemsUploadPath)) {
                mkdir($productItemsUploadPath, 0777);
            }

            $file = UploadedFile::getInstance($model, 'image');
            $filename = md5(date('Y-m-d H:i:s')) . '.' . $file->extension;
            $file->saveAs($productItemsUploadPath .'/' .$filename);
            $model->image = $filename;
            $model->save();
            return $this->redirect(['create', 'product_id' => $model->product_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing ProductItems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $productID = Yii::$app->request->get('product_id');
        $model = $this->findModel($id);
        $model->product_id = $productID;
        $image = $model->image;
        $searchModel = new ProductItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['product_id'=>$productID]);

        if ($model->load(Yii::$app->request->post())) {
            $uploadPath = Yii::getAlias('@root').'/common/uploads/product/';
            if(!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777);
            }
            $productUploadPath = $uploadPath.'/'. $model->product_id;
            $productItemsUploadPath = $productUploadPath.'/'. $model->id;
            if(!is_dir($productUploadPath)) {
                mkdir($productUploadPath, 0777);
            }

            if(!is_dir($productItemsUploadPath)) {
                mkdir($productItemsUploadPath, 0777);
            }

            $file = UploadedFile::getInstance($model, 'image');
            if($file) {
                $filename = md5(date('Y-m-d H:i:s')) . '.' . $file->extension;
                $file->saveAs($productItemsUploadPath .'/' .$filename);
                $image = $filename;
            }
            $model->image = $image;
            $model->save();
            return $this->redirect(['create', 'product_id' => $model->product_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing ProductItems model.
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
     * Finds the ProductItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductItems::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
