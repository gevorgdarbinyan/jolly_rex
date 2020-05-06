<?php

namespace common\models\entertainer;

use Yii;

/**
 * This is the model class for table "{{%tbl_entertainer_order_notifications}}".
 *
 * @property int $id
 * @property int $entertainer_id
 * @property int $customer_id
 * @property int $entertainer_order_id
 * @property int $to_admin
 * @property string $message
 * @property int $confirmed_by_admin
 * @property int $sent_by_entertainer
 * @property int $sent_by_customer
 * @property string $created_date
 */
class EntertainerOrderNotifications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_entertainer_order_notifications}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entertainer_id', 'customer_id', 'entertainer_order_id', 'to_admin', 'confirmed_by_admin', 'sent_by_entertainer', 'sent_by_customer'], 'integer'],
            [['message'], 'string'],
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
            'entertainer_id' => 'Entertainer ID',
            'customer_id' => 'Customer ID',
            'entertainer_order_id' => 'Entertainer Order ID',
            'to_admin' => 'To Admin',
            'message' => 'Message',
            'confirmed_by_admin' => 'Confirmed By Admin',
            'sent_by_entertainer' => 'Sent By Entertainer',
            'sent_by_customer' => 'Sent By Customer',
            'created_date' => 'Created Date',
        ];
    }

    public function getEntertainerOrder_relation(){
        return $this->hasOne(EntertainerOrders::className(), ['id' => 'entertainer_order_id']);
    }
}
