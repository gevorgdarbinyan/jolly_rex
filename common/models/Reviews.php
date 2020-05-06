<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_reviews}}".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $supplier_id
 * @property string $comment
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_reviews}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'supplier_id', 'order_id'], 'integer'],
            [['comment'], 'string'],
            // [['entertainers_point','overall_program_points']],
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
            'supplier_id' => 'Supplier',
            'order_id' => 'Order',
            'comment' => 'Comment',
            'entertainers_point' => 'Entertainers',
            'overall_program_point' => 'Overall Program',
            'keep_anonymous' => 'Keep Anonymous'
        ];
    }

    /**
     * saves data
     */
    public function doSave($data)
    {
        $this->customer_id = $data['customer_id'];
        $this->supplier_id = $data['entertainer_id'];
        $this->order_id = $data['order_id'];
        $this->comment = $data['comment'];
        $this->entertainers_point = $data['entertainers_point'];
        $this->overall_program_point = $data['overall_program_point'];
        $this->keep_anonymous = $data['keep_anonymous'];
        $this->save();
    }
}
