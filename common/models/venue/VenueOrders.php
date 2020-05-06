<?php

namespace common\models\venue;

use Yii;

/**
 * This is the model class for table "{{%tbl_venue_orders}}".
 *
 * @property int $id
 * @property int $venue_id
 * @property int $order_id
 * @property double $price
 * @property string $event_date
 * @property string $start_time
 * @property string $end_time
 */
class VenueOrders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_venue_orders}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'venue_id', 'order_id'], 'integer'],
            [['price'], 'number'],
            [['event_date', 'start_time', 'end_time'], 'safe'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'venue_id' => 'Venue ID',
            'order_id' => 'Order ID',
            'customer_id' => 'Customer',
            'price' => 'Price',
            'event_date' => 'Event Date',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
        ];
    }

    /**
     * gets active venue order for the given customer
     */
    public function getActiveOrder($customerID, $entertainerID = null){
        /*$whereCondition = [];
        if($entertainerID) {
            $whereCondition[] = 'orders.entertainer_id = '.intval($entertainerID).'';
        }
        $where = implode(' AND ',$whereCondition);*/

        $query = "
            SELECT 
                * 
            FROM tbl_venue_orders venue_orders
            JOIN tbl_venue venue ON venue_orders.venue_id = venue.id
            JOIN tbl_orders orders ON venue_orders.order_id = orders.id
            WHERE orders.customer_id = ".intval($customerID)." AND orders.entertainer_id=".intval($entertainerID)." AND orders.status='active'
            LIMIT 1
        ";
        return Yii::$app->db->createCommand($query)->queryOne();
    }
}
