<?php

namespace frontend\components;

use yii\base\Component;
use yii\helpers\ArrayHelper;
use common\models\User;
use common\models\Orders;
use common\models\entertainer\EntertainerStaff;
use Yii;
use common\models\entertainer\EntertainerServices;

class Helper extends Component {
    public function getUserUserTypesData($userID) {
        return $userData = User::find()
        ->select([
            'tbl_user_types.name AS user_type_name'
        ])
        ->leftJoin('tbl_user_types', 'tbl_user.user_type_id = tbl_user_types.id')
        ->where(['tbl_user.id'=>$userID])
        ->asArray()
        ->one();
    }

    public function getOrderPriceSetups($orderID, $entertainerID, $customerID) {
        $data = Orders::find()
                ->select([
                    'tbl_party_theme_relation.name',
                    'tbl_entertainer_services.price',
                ])
                ->leftJoin('tbl_entertainer_order_price_setup', 'tbl_orders.id = tbl_entertainer_order_price_setup.order_id')
                ->leftJoin('tbl_entertainer_services', 'tbl_entertainer_services.id = tbl_entertainer_order_price_setup.entertainer_service_id')
                ->leftJoin('tbl_party_theme_relation', 'tbl_entertainer_services.party_theme_rel_id = tbl_party_theme_relation.id')
                ->where([
                    'tbl_entertainer_order_price_setup.entertainer_id' => $entertainerID,
                    'tbl_entertainer_order_price_setup.customer_id'=>$customerID,
                    'tbl_entertainer_order_price_setup.order_id'=>$orderID
                    ]
                )
                ->asArray()
                ->all();
        return $data;
    }

    public function getRemainingEntertainersCount($orderID, $entertainerID, $customerID) {
        $usedEntertainersCount = Orders::find()
                ->leftJoin('tbl_entertainer_order_price_setup', 'tbl_orders.id = tbl_entertainer_order_price_setup.order_id')
                ->leftJoin('tbl_entertainer_services', 'tbl_entertainer_services.id = tbl_entertainer_order_price_setup.entertainer_service_id')
                ->leftJoin('tbl_party_theme_relation', 'tbl_entertainer_services.party_theme_rel_id = tbl_party_theme_relation.id')
                ->where([
                    'tbl_entertainer_order_price_setup.entertainer_id' => $entertainerID,
                    'tbl_entertainer_order_price_setup.customer_id'=>$customerID,
                    'tbl_entertainer_order_price_setup.order_id'=>$orderID
                    ]
                )
                ->sum('entertainers_number');

        $entertainersCount = EntertainerStaff::find()->where(['enteratainer_id'=>$entertainerID])->count();
        
        return ($usedEntertainersCount > 0 && $entertainersCount > 0) ? ($entertainersCount - $usedEntertainersCount) : 'No entertainers are available';
    }
    
    public function resizeImage($image) {
        $img = @imagecreatefromjpeg($file);
    }

    /**
     * gets weeks array for given month
     */
    function weeksInMonth($month, $year){
        $dates = [];

        $week = 1;
        $date = new \DateTime("$year-$month-01");
        $days = (int)$date->format('t'); // total number of days in the month

        $oneDay = new \DateInterval('P1D');

        for ($day = 1; $day <= $days; $day++) {
            $dates["Week $week"] []= $date->format('Y-m-d');

            $dayOfWeek = $date->format('l');
            if ($dayOfWeek === 'Sunday') {
                $week++;
            }

            $date->add($oneDay);
        }

        return $dates;
    }
}
