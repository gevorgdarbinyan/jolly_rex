<?php

namespace common\models\product;

use Yii;
use common\models\Product;

/**
 * This is the model class for table "{{%tbl_product_items}}".
 *
 * @property int $id
 * @property int $product_id
 * @property string $name
 * @property double $price
 * @property string $image
 */
class ProductItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_product_items}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
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
            'product_id' => 'Product ID',
            'name' => 'Name',
            'price' => 'Price',
            'image' => 'Image',
        ];
    }

    public function getProduct_relation() {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
