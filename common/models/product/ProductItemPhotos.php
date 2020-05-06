<?php

namespace common\models\product;

use Yii;

/**
 * This is the model class for table "{{%tbl_product_items_photos}}".
 *
 * @property int $id
 * @property int $product_item_id
 * @property string $photo
 * @property string $type
 */
class ProductItemPhotos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_product_item_photos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_item_id'], 'integer'],
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
            'product_item_id' => 'Product Item ID',
            'photo' => 'Photo',
            'type' => 'Type',
        ];
    }
}
