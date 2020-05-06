<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Reviews;

/**
 * Site controller
 */
class ReviewsController extends Controller {

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
     * Lists all User models.
     * @return mixed
     */
    public function actionRateEntertainer($customer, $entertainer, $order) {
        return $this->render('rate-entertainer', ['customer'=>$customer,'entertainer'=>$entertainer,'order'=>$order]);
    }

    public function actionThankYou() {
        $post = Yii::$app->request->post('Reviews');
        $review = new Reviews;
        $review->doSave(['entertainer_id'=>$post['entertainer_id'],'customer_id'=>$post['customer_id'],'order_id'=>$post['order_id'],'comment'=>$post['comment'],'entertainers_point'=>$post['entertainers_point'],'overall_program_point'=>$post['overall_program_point'],'keep_anonymous'=>(isset($post['keep_anonymous'])) ? 1 : 0]);
        return $this->render('thank-you');
    }
}