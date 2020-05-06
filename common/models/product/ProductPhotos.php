<?php

namespace common\models\product;

use Yii;

/**
 * This is the model class for table "{{%tbl_product_photos}}".
 *
 * @property int $id
 * @property int $product_id
 * @property string $photo
 * @property string $type
 */
class ProductPhotos extends \yii\db\ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_product_photos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
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
            'product_id' => 'Product ID',
            'photo' => 'Photo',
            'type' => 'Type',
        ];
    }
}
