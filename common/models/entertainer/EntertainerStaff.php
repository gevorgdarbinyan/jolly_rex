<?php

namespace common\models\entertainer;

use Yii;

/**
 * This is the model class for table "{{%tbl_entertainer_staff}}".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $photo
 * @property int $user_id
 */
class EntertainerStaff extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_entertainer_staff}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['photo'], 'string'],
            [['entertainer_id'], 'integer'],
            [['first_name'], 'string', 'max' => 100],
            [['last_name'], 'string', 'max' => 255],
            [['day'], 'string', 'max' => 20]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'photo' => 'Photo',
            'entertainer_id' => 'Entertainer',
            'date' => 'Date',
            'start_time' => 'Start time',
            'end_time' => 'End time',
            'day' => 'Day'
        ];
    }

    public function getFullName(){
        return $this->first_name.' '.$this->last_name;
    }

    public function getFullNameAbbr(){
        return ucfirst($this->first_name)[0].'.'.ucfirst($this->last_name)[0].'.';
    }
}
