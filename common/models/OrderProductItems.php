<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_order_product_items}}".
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $product_item_id
 * @property double $price
 * @property int $count
 */
class OrderProductItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_order_product_items}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'product_item_id', 'count'], 'integer'],
            [['price'], 'number'],
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
            'product_id' => 'Product ID',
            'product_item_id' => 'Product Item ID',
            'price' => 'Price',
            'count' => 'Count',
        ];
    }
}
