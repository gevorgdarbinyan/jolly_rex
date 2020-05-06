<?php

namespace common\models\entertainer;

use Yii;

/**
 * This is the model class for table "{{%tbl_entertainer_enquiries}}".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $entertainer_id
 * @property string $option1_date
 * @property string $option1_start_time
 * @property string $option1_end_time
 * @property string $option2_date
 * @property string $option2_start_time
 * @property string $option2_end_time
 * @property string $option3_date
 * @property string $option3_start_time
 * @property string $option3_end_time
 * @property int $party_type_id
 * @property double $price
 * @property string $special_requests
 * @property int $host_child_age
 * @property string $host_child_gender
 * @property string $host_child_name
 * @property string $title
 * @property string $name
 * @property string $telephone_number
 * @property string $mobile_number
 * @property string $email
 * @property int $entertainers_count
 * @property string $first_line_address
 * @property string $post_code
 * @property string $area
 * @property string $city
 * @property string $youngest_age
 * @property string $oldest_age
 * @property string $status
 * @property string $theme_service_id
 */
class EntertainerEnquiries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_entertainer_enquiries}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'entertainer_id', 'party_type_id', 'host_child_age', 'entertainers_count','theme_service_id','additional_service_id','order_id'], 'integer'],
            [['option1_date', 'option1_start_time', 'option1_end_time', 'option2_date', 'option2_start_time', 'option2_end_time', 'option3_date', 'option3_start_time', 'option3_end_time'], 'safe'],
            [['price'], 'number'],
            [['special_requests', 'first_line_address', 'area', 'city','title','name','email','mobile_number','youngest_age','oldest_age'], 'string'],
            [['host_child_gender'], 'string', 'max' => 10],
            [['host_child_name'], 'string', 'max' => 50],
            [['telephone_number', 'post_code', 'status'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'entertainer_id' => 'Entertainer ID',
            'option1_date' => 'Option1 Date',
            'option1_start_time' => 'Option1 Start Time',
            'option1_end_time' => 'Option1 End Time',
            'option2_date' => 'Option2 Date',
            'option2_start_time' => 'Option2 Start Time',
            'option2_end_time' => 'Option2 End Time',
            'option3_date' => 'Option3 Date',
            'option3_start_time' => 'Option3 Start Time',
            'option3_end_time' => 'Option3 End Time',
            'party_type_id' => 'Party Type ID',
            'price' => 'Price',
            'special_requests' => 'Special Requests',
            'host_child_age' => 'Host Child Age',
            'host_child_gender' => 'Host Child Gender',
            'host_child_name' => 'Host Child Name',
            'telephone_number' => 'Telephone Number',
            'entertainers_count' => 'Entertainers Count',
            'first_line_address' => 'First Line Address',
            'post_code' => 'Post Code',
            'area' => 'Area',
            'city' => 'City',
            'status' => 'Status',
            'theme_service_id' => 'Theme Service',
            'additional_service_id' => 'Additional Service',
            'order_id' => 'Order'
        ];
    }
}
