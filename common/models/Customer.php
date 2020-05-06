<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_customer}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $description
 * @property string $postal_code
 * @property string $address
 * @property string $phone_number
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_customer}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['description', 'address'], 'string'],
            [['first_name', 'last_name'], 'string', 'max' => 100],
            [['postal_code'], 'string', 'max' => 20],
            [['phone_number'], 'string', 'max' => 30],
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
            'description' => 'Description',
            'postal_code' => 'Postal Code',
            'address' => 'Address',
            'phone_number' => 'Phone Number',
        ];
    }

    public function getUser_relation(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getFullName(){
        return $this->first_name.' '. $this->last_name;
    } 
}
