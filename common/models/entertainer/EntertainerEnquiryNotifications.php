<?php

namespace common\models\entertainer;

use Yii;

/**
 * This is the model class for table "{{%tbl_entertainer_enquiry_notifications}}".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $entertainer_id
 * @property int $enquiry_id
 * @property string $note
 * @property int $creator_id
 * @property string $created_date
 */
class EntertainerEnquiryNotifications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_entertainer_enquiry_notifications}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'entertainer_id', 'enquiry_id', 'creator_id'], 'integer'],
            [['note'], 'string'],
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
            'customer_id' => 'Customer',
            'entertainer_id' => 'Entertainer',
            'enquiry_id' => 'Enquiry',
            'note' => 'Note',
            'creator_id' => 'Creator',
            'created_date' => 'Created Date',
        ];
    }
}
