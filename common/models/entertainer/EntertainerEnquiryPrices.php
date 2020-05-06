<?php

namespace common\models\entertainer;

use Yii;

/**
 * This is the model class for table "{{%tbl_entertainer_enquiry_prices}}".
 *
 * @property int $id
 * @property int $entertainer_id
 * @property int $customer_id
 * @property int $enquiry_id
 * @property int $entertainer_service_id
 * @property int $extra_guest_count
 * @property string $service_type
 */
class EntertainerEnquiryPrices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_entertainer_enquiry_prices}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entertainer_id', 'customer_id', 'enquiry_id', 'entertainer_service_id', 'extra_guest_count'], 'integer'],
            [['extra_guest_count', 'service_type'], 'required'],
            [['service_type'], 'string', 'max' => 100],
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
            'enquiry_id' => 'Enquiry',
            'entertainer_service_id' => 'Entertainer Service',
            'extra_guest_count' => 'Extra Guest Count',
            'service_type' => 'Service Type',
        ];
    }
}
