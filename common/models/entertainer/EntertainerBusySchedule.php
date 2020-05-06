<?php

namespace common\models\entertainer;

use Yii;

/**
 * This is the model class for table "{{%tbl_entertainer_busy_schedule}}".
 *
 * @property int $id
 * @property int $entertainer_id
 * @property string $busy_date
 * @property string $busy_start_time
 * @property string $busy_end_time
 */
class EntertainerBusySchedule extends \yii\db\ActiveRecord
{
    const BLOCKED_FOR_JOLLY_REX_CLIENT = 1;
    const NOT_AVAILABLE_FOR_WORK = 2;
    const BLOCKED_FOR_JOLLY_REX_CLIENT_ENQUIRY = 3;
    const BLOCKED_FOR_EXTERNAL = 4;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_entertainer_busy_schedule}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entertainer_id','order_id'], 'integer'],
            [['reason'], 'integer'],
            [['busy_date', 'busy_start_time', 'busy_end_time'], 'safe'],
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
            'busy_date' => 'Busy Date',
            'busy_start_time' => 'Busy Start Time',
            'busy_end_time' => 'Busy End Time',
            'reason' => 'Reason',
            'order_id' => 'Order'
        ];
    }
}
