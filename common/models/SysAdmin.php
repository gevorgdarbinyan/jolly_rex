<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_admin}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 */
class SysAdmin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_admin}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 100],
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
        ];
    }
}
