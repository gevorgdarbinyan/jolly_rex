<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_food_item_photos}}".
 *
 * @property int $id
 * @property int $food_item_id
 * @property string $photo
 * @property string $type
 */
class FoodItemPhotos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_food_item_photos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['food_item_id'], 'integer'],
            [['photo'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'food_item_id' => 'Food Item ID',
            'photo' => 'Photo',
            'type' => 'Type',
        ];
    }
}
