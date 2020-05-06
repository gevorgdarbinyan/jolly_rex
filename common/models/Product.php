<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_product}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property int $delivery
 * @property int $rating
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'delivery', 'rating'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'description' => 'Description',
            'delivery' => 'Delivery',
            'rating' => 'Rating',
        ];
    }

    public function getUser_relation() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
