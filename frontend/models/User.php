<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_user}}".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $status
 * @property int $user_type_id
 */
class User extends \yii\db\ActiveRecord
{
    
    public $range_from_price;
    public $range_to_price;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_type_id'], 'integer'],
            [['username'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 32],
            [['status'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'status' => 'Status',
            'user_type_id' => 'User Type ID',
        ];
    }
}
