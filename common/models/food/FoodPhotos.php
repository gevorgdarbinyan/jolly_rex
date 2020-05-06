<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_food_photos}}".
 *
 * @property int $id
 * @property int $food_id
 * @property string $photo
 * @property string $type
 */
class FoodPhotos extends \yii\db\ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_food_photos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['food_id'], 'integer'],
            [['photo'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'food_id' => 'Food ID',
            'photo' => 'Photo',
            'type' => 'Type',
        ];
    }
}
