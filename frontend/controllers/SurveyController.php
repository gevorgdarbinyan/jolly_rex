<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use common\models\UserPhotos;
use common\models\Reviews;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\Orders;
use common\models\UserTypes;
use common\models\entertainer\EntertainerPartyThemes;
use yii2fullcalendar\models\Event;
use yii\helpers\ArrayHelper;
use common\models\entertainer\EntertainerServices;

/**
 * Site controller
 */
class SurveyController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
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
     * draws surveys form
     * @return mixed
     */
    public function actionIndex() {
        return $this->render('index', []);
    }
}
