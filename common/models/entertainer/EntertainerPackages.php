<?php

namespace common\models\entertainer;

use Yii;

/**
 * This is the model class for table "{{%tbl_entertainer_packages}}".
 *
 * @property int $id
 * @property int $entertainer_id
 * @property string $name
 * @property double $price
 */
class EntertainerPackages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_entertainer_packages}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entertainer_id'], 'integer'],
            [['price'], 'number'],
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
            'entertainer_id' => 'Entertaner',
            'name' => 'Name',
            'price' => 'Price',
        ];
    }

    public function getUser_relation() {
        return $this->hasOne(User::className(), ['id' => 'entertainer_id']);
    }
}
