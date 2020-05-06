<?php

namespace common\models\entertainer;

use Yii;

/**
 * This is the model class for table "{{%tbl_entertainer_order_prices}}".
 *
 * @property int $id
 * @property int $entertainer_id
 * @property int $customer_id
 * @property int $order_id
 * @property int $entertainer_service_id
 */
class EntertainerOrderPrices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_entertainer_order_prices}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entertainer_id', 'customer_id', 'order_id', 'entertainer_service_id'], 'integer'],
            [['service_type'],'string']
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
            'customer_id' => 'Customer',
            'order_id' => 'Order ID',
            'entertainer_service_id' => 'Entertainer Service',
            'extra_guest_count' => 'Extra guest count'
        ];
    }

    public function getOrderServices($orderID, $type) {
        $entertainerOrderServices = self::find()->where(['order_id'=>$orderID,'service_type'=>$type])->all();
        return array_map(function($item){
            return ['entertainer_service_id'=>$item['entertainer_service_id'],'extra_guest_count'=>$item['extra_guest_count']];
        }, $entertainerOrderServices);
    }
}
