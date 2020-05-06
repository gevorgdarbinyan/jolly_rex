<?php

namespace backend\controllers;

use Yii;
use common\models\entertainer\EntertainerServices;
use common\models\entertainer\EntertainerServicesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EntertainerServicesController implements the CRUD actions for EntertainerServices model.
 */
class EntertainerServicesController extends Controller
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
     * Creates a new EntertainerServices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $entertainerID = Yii::$app->request->get('entertainer_id');

        $model = new EntertainerServices();
        $model->entertainer_id = $entertainerID;

        $searchModel = new EntertainerServicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['entertainer_id'=>$entertainerID]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['create', 'entertainer_id' => $model->entertainer_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Updates an existing EntertainerServices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $entertainerID = Yii::$app->request->get('entertainer_id');
        $model = $this->findModel($id);
        $model->entertainer_id = $entertainerID;

        $searchModel = new EntertainerServicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['entertainer_id'=>$entertainerID]);

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            return $this->redirect(['create', 'entertainer_id' => $model->entertainer_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing EntertainerServices model.
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
     * Finds the EntertainerServices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EntertainerServices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EntertainerServices::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
