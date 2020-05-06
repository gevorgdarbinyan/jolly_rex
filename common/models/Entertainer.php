<?php

namespace common\models;

use Yii;
use common\models\entertainer\EntertainerStaff;
use common\models\entertainer\EntertainerServices;

/**
 * This is the model class for table "{{%tbl_entertainer}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $first_name
 * @property string $last_name
 * @property int $support_instant_booking
 * @property string $short_description
 * @property string $description
 * @property string $price_description
 * @property string $package_description
 * @property int $rating
 * @property string $first_line_address
 * @property string $post_code
 * @property string $area
 * @property string $city
 * @property string $phone_number
 * @property string $video
 * @property string $mileage_price
 */
class Entertainer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_entertainer}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'support_instant_booking', 'rating'], 'integer'],
            [['short_description', 'description', 'price_description', 'package_description', 'first_line_address', 'video','post_code','area','city'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['first_name', 'last_name'], 'string', 'max' => 100],
            [['mileage_price','support_mileage'],'number'],
            [['phone_number'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'support_instant_booking' => 'Support Instant Booking',
            'short_description' => 'Short Description',
            'description' => 'Description',
            'price_description' => 'Price Description',
            'package_description' => 'Package Description',
            'rating' => 'Rating',
            'first_line_address' => 'Address',
            'phone_number' => 'Phone Number',
            'video' => 'Video',
            'post_code' => 'Postal code',
            'area' => 'Area',
            'city' => 'City',
            'support_mileage' => 'Support mileage',
            'mileage_price' => 'Mileage price'
        ];
    }

    public function getUser_relation(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function getEntertainerStaff($entertainerID){
        return EntertainerStaff::find()->where(['entertainer_id'=>$entertainerID])->all();
    }
}
