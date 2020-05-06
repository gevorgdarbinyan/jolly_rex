<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_orders}}".
 *
 * @property int $id
 * @property string $title
 * @property int $customer_id
 * @property int $entertainer_id
 * @property int $venue_id
 * @property string $status
 */
class Orders extends \yii\db\ActiveRecord
{

    public $event_date;
    public $start_time;
    public $end_time;
    public $party_type_id;
    public $entertainers_count;
    public $special_request;
    public $special_requests;
    public $host_child_age;
    public $host_child_name;
    public $host_child_gender;
    public $price_type;
    public $telephone_number;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_orders}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'entertainer_id','venue_id','food_id','product_id','creator_id'], 'integer'],
            [['price'], 'required'],
            // [['start_time', 'end_time', 'host_child_age','host_child_gender','telephone_number','venue_address','price_type','entertainers_count'], 'safe'],
            [['status'], 'string', 'max' => 50],
            [['order_type'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer',
            'entertainer_id' => 'Entertainer',
            'venue_id' => 'Venue',
            'status' => 'Status',
            'price' => 'Price',
            'order_type' => 'Order type'
        ];
    }

    /**
     * gets user orders count 
     */
    public function getUserOrdersCount($userID){
        return Orders::find()->where(['customer_id'=>$userID])->count();
    }

    public function getCustomer_relation() {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    public function getEntertainer_relation() {
        return $this->hasOne(Entertainer::className(), ['id' => 'entertainer_id']);
    }

    public function getVenue_relation() {
        return $this->hasOne(Venue::className(), ['id' => 'venue_id']);
    }

    public function getFood_relation() {
        return $this->hasOne(Food::className(), ['id' => 'food_id']);
    }

    public function getProduct_relation() {
        return $this->hasOne(Product::className(), ['id' => 'food_id']);
    }

    public function getPartyType_relation(){
        return $this->hasOne(PartyType::className(), ['id' => 'party_type_id']);
    }

    public function getEntertainerPackage_relation() {
        return $this->hasOne(EntertainerPackages::className(), ['id' => 'entertainer_package_id']);
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
}
