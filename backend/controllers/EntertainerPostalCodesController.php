<?php

namespace backend\controllers;

use Yii;
use common\models\entertainer\EntertainerPostalCodes;
use common\models\entertainer\EntertainerPostalCodesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EntertainerPostalCodesController implements the CRUD actions for EntertainerPostalCodes model.
 */
class EntertainerPostalCodesController extends Controller
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
     * Lists all EntertainerPostalCodes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EntertainerPostalCodesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EntertainerPostalCodes model.
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
     * Creates a new EntertainerPostalCodes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $entertainerID = Yii::$app->request->get('entertainer_id');
        $model = new EntertainerPostalCodes();
        $model->entertainer_id = $entertainerID;
        $model->creator_id = Yii::$app->user->identity->id;
        $searchModel = new EntertainerPostalCodesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['entertainer_id'=>$entertainerID]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['create', 'entertainer_id' => $entertainerID]);
        }

        return $this->render('create', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    /**
     * Updates an existing EntertainerPostalCodes model.
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
        $model->creator_id = Yii::$app->user->identity->id;

        $searchModel = new EntertainerPostalCodesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['entertainer_id'=>$entertainerID]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['create', 'entertainer_id' => $entertainerID]);
        }

        return $this->render('update', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    /**
     * Deletes an existing EntertainerPostalCodes model.
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
     * Finds the EntertainerPostalCodes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EntertainerPostalCodes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EntertainerPostalCodes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
