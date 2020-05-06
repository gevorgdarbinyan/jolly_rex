<?php

namespace frontend\controllers;

use yii\web\Controller;
use common\models\Product;
use common\models\product\ProductItems;

class ProductController extends Controller {
    
    public function actionIndex($id)
    {
        $productItemsData = ProductItems::find()->where(['product_id' => $id])->all();
        return $this->render('index', [
            'productItemsData' => $productItemsData
        ]);
    }
    
    public function actionProviders()
    {
        $productProvidersData = Product::find()->all();
        return $this->render('providers', [
            'productProvidersData' => $productProvidersData
        ]);
    }
    
    public function actionPage($id)
    {
        $productItemData = ProductItems::findOne($id);
        return $this->render('page', [
            'productItemData' => $productItemData
        ]);
    }
    
}
