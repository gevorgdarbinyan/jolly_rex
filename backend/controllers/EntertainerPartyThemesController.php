<?php

namespace backend\controllers;

use Yii;
use common\models\entertainer\EntertainerPartyThemes;
use common\models\entertainer\EntertainerPartyThemesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EntertainerPatyThemesController implements the CRUD actions for EntertainerPartyThemes model.
 */
class EntertainerPartyThemesController extends Controller
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
     * Lists all EntertainerPartyThemes models.
     * @return mixed
     */
    public function actionIndex()
    {
        var_dump("aaa");
        $searchModel = new EntertainerPatyThemesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EntertainerPartyThemes model.
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
     * Creates a new EntertainerPartyThemes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $entertainerID = Yii::$app->request->get('entertainer_id');

        $model = new EntertainerPartyThemes();
        $model->entertainer_id = $entertainerID;

        $searchModel = new EntertainerPartyThemesSearch();
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
     * Updates an existing EntertainerPartyThemes model.
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

        $searchModel = new EntertainerPartyThemesSearch();
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
     * Deletes an existing EntertainerPartyThemes model.
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
     * Finds the EntertainerPartyThemes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EntertainerPartyThemes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EntertainerPartyThemes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
