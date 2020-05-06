<?php

namespace common\models\entertainer;

use Yii;

/**
 * This is the model class for table "{{%tbl_entertainer_orders_staff}}".
 *
 * @property int $id
 * @property int $entertainer_order_id
 * @property int $entertainer_staff_id
 * @property int $creator_id
 * @property string $created_date
 */
class EntertainerOrdersStaff extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_entertainer_orders_staff}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entertainer_order_id', 'entertainer_staff_id', 'creator_id'], 'integer'],
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
            'entertainer_order_id' => 'Entertainer Order ID',
            'entertainer_staff_id' => 'Entertainer Staff ID',
            'creator_id' => 'Creator ID',
            'created_date' => 'Created Date',
        ];
    }
}
