<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\product\ProductItemPhotos;
use common\models\product\ProductItemPhotosSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductOptionsController implements the CRUD actions for ProductOptions model.
 */
class ProductPhotosController extends Controller
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
     * Creates a new ProductPhotos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $productID = Yii::$app->request->get('product_id');
        $productItemID = Yii::$app->request->get('id');
        $model = new ProductItemPhotos();
        $searchModel = new ProductItemPhotosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['product_item_id' => $productItemID]);

        if ($model->load(Yii::$app->request->post())) {
            $type = $model->type;
            $uploadPath = Yii::getAlias('@root') . '/common/uploads';
            $productUploadPath = $uploadPath . '/product';
            if ($type) {
                /* TODO Delete All Main Photos */
                if(!is_dir($productUploadPath)) {
                    mkdir($productUploadPath, 0777, true);
                }
                $productUploadIDPath = $productUploadPath . '/' . $productID . '/' . $productItemID;
                $productTypePhotoPath = $productUploadIDPath . '/' . $type;
                if(!is_dir($productUploadIDPath)) {
                    mkdir($productUploadIDPath, 0777, true);
                }
                if(!is_dir($productTypePhotoPath)) {
                    mkdir($productTypePhotoPath, 0777, true);
                }
                $file = UploadedFile::getInstance($model, 'photo');
                if($file) {
                    $filename = md5(date('Y-m-d H:i:s')) . '.' . $file->extension;
                    $file->saveAs($productTypePhotoPath .'/' .$filename);
                    $model->photo = $filename;
                }
                $model->product_item_id = $productItemID;
                $model->save();
                if ($type == 'main') {
                    Yii::$app->db->createCommand()->update('tbl_product_items', ['image' => $filename], 'id = ' . $productItemID)->execute();
                }
            }
            
            return $this->redirect(['create', 'product_id' => $productID, 'id' => $productItemID]);
        }

        return $this->render('create', [
            'productID' => $productID,
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing ProductPhotos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $productID = Yii::$app->request->get('product_id');
        $model = $this->findModel($id);
        $photo = $model->photo;
        $searchModel = new ProductPhotosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['product_id'=>$productID]);

        if ($model->load(Yii::$app->request->post())) {
            $type = $model->type;
            $uploadPath = Yii::getAlias('@root').'/common/uploads';
            $productUploadPath = $uploadPath.'/product';
            if(!is_dir($productUploadPath)) {
                mkdir($productUploadPath, 0777);
            }
            $productUploadIDPath = $productUploadPath.'/'. $productID;
            $productTypePhotoPath = $productUploadIDPath.'/'.$type;
            if(!is_dir($productUploadIDPath)) {
                mkdir($productUploadIDPath, 0777);
            }
            if(!is_dir($productTypePhotoPath)) {
                mkdir($productTypePhotoPath, 0777);
            }
            $file = UploadedFile::getInstance($model, 'photo');
            if($file) {
                $filename = md5(date('Y-m-d H:i:s')) . '.' . $file->extension;
                $file->saveAs($productTypePhotoPath .'/' .$filename);
                $photo = $filename;
            }
            $model->photo = $photo;
            $model->save();
            return $this->redirect(['create', 'product_id' => $productID]);
        }

        return $this->render('update', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Finds the ProductPhotos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductPhotos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductPhotos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
