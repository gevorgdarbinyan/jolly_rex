<?php

namespace backend\controllers;

use Yii;
use common\models\entertainer\EntertainerOrders;
use common\models\entertainer\EntertainerOrdersSearch;
use common\models\entertainer\EntertainerOrderNotifications;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EntertainerOrdersController implements the CRUD actions for EntertainerOrders model.
 */
class EntertainerOrdersController extends Controller
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
     * Lists all EntertainerOrders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EntertainerOrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EntertainerOrders model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EntertainerOrders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EntertainerOrders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EntertainerOrders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EntertainerOrders model.
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
     * Finds the EntertainerOrders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EntertainerOrders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EntertainerOrders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionApproveStatus(){
        if(Yii::$app->request->isAjax) {
            //echo 1;die;
            $entertainerOrderID = Yii::$app->request->post('entertainer_order_id');
            $entertainerOrders = EntertainerOrders::findOne($entertainerOrderID);
            $entertainerOrders->status = 'FulFilled';
            //$entertainerOrders->save();
            // change status
            echo 'http://jolly-rex.front/reviews/rate-entertainer?customer='.$entertainerOrders['customer_id'].'&entertainer='.$entertainerOrders['entertainer_id'].'&order='.$entertainerOrders['order_id'];
        }
    }

    public function actionNotifications($id){
        $entertainerOrders = EntertainerOrders::findOne($id);
        //out($entertainerOrders);
        $entertainerOrderNotifications = EntertainerOrderNotifications::find()
                                        // ->with(['entertainerOrder_relation','entertainerOrder_relation.entertainer_relation','entertainerOrder_relation.customer_relation'])
                                        ->where(['entertainer_order_id'=>$id])
                                        ->all();

        return $this->render('notifications',['entertainerOrders'=>$entertainerOrders,'entertainerOrderNotifications'=>$entertainerOrderNotifications]);

    }
}
