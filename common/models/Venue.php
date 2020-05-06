<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_venue}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property int $support_instant_booking
 * @property string $short_description
 * @property string $description
 * @property int $rating
 * @property double $price
 * @property string $postal_code
 */
class Venue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_venue}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'support_instant_booking', 'rating'], 'integer'],
            [['short_description', 'description'], 'string'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['postal_code'], 'string', 'max' => 20],
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
            'support_instant_booking' => 'Support Instant Booking',
            'short_description' => 'Short Description',
            'description' => 'Description',
            'rating' => 'Rating',
            'price' => 'Price',
            'postal_code' => 'Postal Code',
        ];
    }

    public function getUser_relation() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
