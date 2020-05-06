<?php

namespace common\models\food;

use Yii;
use common\models\Food;

/**
 * This is the model class for table "{{%tbl_food_items}}".
 *
 * @property int $id
 * @property int $food_id
 * @property string $name
 * @property double $price
 * @property string $image
 */
class FoodItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_food_items}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['food_id'], 'integer'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 500],
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
            'name' => 'Name',
            'price' => 'Price',
            'image' => 'Image',
        ];
    }

    public function getFood_relation() {
        return $this->hasOne(Food::className(), ['id' => 'food_id']);
    }
}
