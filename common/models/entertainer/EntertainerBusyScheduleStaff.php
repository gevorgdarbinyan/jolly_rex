<?php

namespace common\models\entertainer;

use Yii;

/**
 * This is the model class for table "{{%tbl_entertainer_orders_staff}}".
 *
 * @property int $id
 * @property int $busy_schedule_id
 * @property int $entertainer_staff_id
 * @property int $creator_id
 * @property string $created_date
 */
class EntertainerBusyScheduleStaff extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_entertainer_busy_schedule_staff}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['busy_schedule_id', 'entertainer_staff_id', 'creator_id'], 'integer'],
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
            'busy_schedule_id' => 'Busy Schedule ID',
            'entertainer_staff_id' => 'Entertainer Staff ID',
            'creator_id' => 'Creator ID',
            'created_date' => 'Created Date',
        ];
    }
}
