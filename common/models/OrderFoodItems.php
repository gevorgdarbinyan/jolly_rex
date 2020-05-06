<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_order_food_items}}".
 *
 * @property int $id
 * @property int $order_id
 * @property int $food_id
 * @property int $food_item_id
 * @property int $count
 * @property double $price
 * @property string $created_date
 */
class OrderFoodItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_order_food_items}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'food_id', 'food_item_id', 'count'], 'integer'],
            [['price'], 'number'],
            [['created_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'food_id' => 'Food ID',
            'food_item_id' => 'Food Item ID',
            'count' => 'Count',
            'price' => 'Price',
            'created_date' => 'Created Date',
        ];
    }
}
