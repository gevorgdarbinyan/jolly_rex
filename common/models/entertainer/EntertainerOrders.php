<?php

namespace common\models\entertainer;

use Yii;
use common\models\PartyType;
use common\models\Entertainer;
use common\models\Customer;

/**
 * This is the model class for table "{{%tbl_entertainer_orders}}".
 *
 * @property int $id
 * @property int $entertainer_id
 * @property int $order_id
 * @property int $party_type_id
 * @property int $theme_service_id
 * @property int $additional_service_id
 * @property int $entertainer_package_id
 * @property string $event_date
 * @property string $start_time
 * @property string $end_time
 * @property int $entertainers_count
 * @property string $special_requests
 * @property double $price
 * @property string $price_type
 * @property int $host_child_age
 * @property string $host_child_gender
 * @property string $host_child_name
 * @property string $telephone_number
 * @property string $venue_address
 * @property string $post_code
 * @property string $city
 * @property string $note
 * @property string $entertainer_name
 * @property string $message
 * @property string $status
 * @property int $customer_id
 * @property string $info_status
 */
class EntertainerOrders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_entertainer_orders}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entertainer_id', 'order_id', 'party_type_id', 'theme_service_id', 'additional_service_id', 'entertainer_package_id', 'entertainers_count', 'host_child_age', 'customer_id'], 'integer'],
            [['event_date', 'start_time', 'end_time'], 'safe'],
            [['special_requests', 'venue_address', 'note', 'message'], 'string'],
            [['price'], 'number'],
            [['price_type', 'host_child_gender'], 'string', 'max' => 10],
            [['host_child_name', 'entertainer_name', 'status', 'info_status'], 'string', 'max' => 50],
            [['telephone_number', 'post_code'], 'string', 'max' => 30],
            [['city'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entertainer_id' => 'Entertainer',
            'order_id' => 'Order',
            'party_type_id' => 'Party Type',
            'theme_service_id' => 'Theme Service ID',
            'additional_service_id' => 'Additional Service ID',
            'entertainer_package_id' => 'Entertainer Package ID',
            'event_date' => 'Event Date',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'entertainers_count' => 'Entertainers Count',
            'special_requests' => 'Special Requests',
            'price' => 'Price',
            'price_type' => 'Price Type',
            'host_child_age' => 'Child Age',
            'host_child_gender' => 'Child Gender',
            'host_child_name' => 'Child Name',
            'telephone_number' => 'Telephone Number',
            'venue_address' => 'Venue Address',
            'post_code' => 'Post Code',
            'city' => 'City',
            'note' => 'Note',
            'entertainer_name' => 'Entertainer Name',
            'message' => 'Message',
            'status' => 'Status',
            'customer_id' => 'Customer ID',
            'info_status' => 'Info Status',
        ];
    }

    public function getPartType_relation(){
        return $this->hasOne(PartyType::className(), ['id' => 'party_type_id']);
    }

    public function getEntertainer_relation(){
        return $this->hasOne(Entertainer::className(), ['id' => 'entertainer_id']);
    }

    public function getCustomer_relation(){
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /*
    *object properties will have given array values
    */
    public function setValues($data) {
        $keys = array_keys($data);
        foreach($keys as $key) {
            $this->{$key} = $data[$key];
        }
        return $this;
    }

    /**
     * gets active entertainer order for the given customer
     */
    public function getActiveOrder($customerID, $entertainerID){
        $query = "
            SELECT 
                * 
            FROM tbl_entertainer_orders entertainer_orders
            JOIN tbl_orders orders ON entertainer_orders.order_id = orders.id
            WHERE orders.customer_id = ".intval($customerID)." AND orders.entertainer_id=".intval($entertainerID)." AND orders.status='active'
            LIMIT 1
        ";
        return Yii::$app->db->createCommand($query)->queryOne();
    }

    /**
     * gets data by order
     * @param $orderID integer
     * @return array
     */
    public function getDataByOrder($orderID) {
        $query = "
            SELECT
                    orders.id AS order_id,
                    entertainer_orders.id,
                    entertainer_orders.entertainer_id,
                    entertainer_orders.customer_id,
                    entertainer_orders.price,
                    orders.status,
                    (SELECT name FROM tbl_party_type WHERE id = entertainer_orders.party_type_id) AS party_type_name,
                    entertainer_orders.event_date,
                    entertainer_orders.start_time,
                    entertainer_orders.end_time,
                    entertainer_orders.entertainers_count,
                    entertainer_orders.host_child_name,
                    entertainer_orders.host_child_age,
                    entertainer_orders.host_child_gender,
                    entertainer_orders.special_requests,
                    entertainer_orders.venue_address,
                    entertainer_orders.post_code,
                    entertainer_orders.city,
                    entertainer_orders.note,
                    entertainer_orders.message
                FROM tbl_orders orders
                INNER JOIN tbl_entertainer_orders entertainer_orders ON orders.id = entertainer_orders.order_id
                WHERE orders.id = ".$orderID."
                ORDER BY entertainer_orders.event_date ASC
            ";
        return Yii::$app->db->createCommand($query)->queryOne();
    }
}
