<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_photographer}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $photo
 * @property string $created_date
 */
class Photographer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_photographer}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['created_date'], 'safe'],
            [['first_name', 'last_name', 'photo'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'photo' => 'Photo',
            'created_date' => 'Created Date',
        ];
    }
}
