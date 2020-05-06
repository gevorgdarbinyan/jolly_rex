<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\food\FoodItems;
use common\models\Food;
use common\models\Orders;

class FoodController extends Controller
{
    
    public function actionIndex($id)
    {
        $foodItemsData = FoodItems::find()->where(['food_id' => $id])->all();
        return $this->render('index', [
            'foodItemsData' => $foodItemsData
        ]);
    }
    
    public function actionProviders()
    {
        $orderID = Yii::$app->request->get('oID');
        $orderData = Orders::findOne($orderID);
        $foodProvidersData = Food::find()->all();
        return $this->render('providers', [
            'foodProvidersData' => $foodProvidersData
        ]);
    }
    
    public function actionPage($id)
    {
        $foodItemData = FoodItems::findOne($id);
        return $this->render('page', [
            'foodItemData' => $foodItemData
        ]);
    }
    
    public function actionLoadAllFoodItems()
    {
        if (Yii::$app->request->isAjax) {
            $searchPattern = Yii::$app->request->post('search_pattern');
            
            if ($searchPattern) {
//                $foodItemsDataQuery = "SELECT * FROM tbl_food_items WHERE name LIKE '%$searchPattern%'";
//                $foodItemsData = Yii::$app->db->createCommand($foodItemsDataQuery)->queryAll();
                $foodItemsData = FoodItems::find()->where(['like', 'name', $searchPattern])->all();
            } else {
                $foodItemsData = FoodItems::find()->all();
            }
                
            $str = '';
            
            $str .= $this->renderAjax('_food_items_template', ['foodItemsData' => $foodItemsData]);
            
            echo $str;
            
        }
    }
    
}
