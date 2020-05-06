<?php

namespace common\models\venue;

use Yii;
use common\models\Venue;

/**
 * This is the model class for table "{{%tbl_venue_options}}".
 *
 * @property int $id
 * @property string $name
 * @property double $price
 * @property string $description
 * @property int $hour
 * @property int $venue_id
 */
class VenueOptions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_venue_options}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['description'], 'string'],
            [['hour', 'venue_id'], 'integer'],
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
            'name' => 'Name',
            'price' => 'Price',
            'description' => 'Description',
            'hour' => 'Hour',
            'venue_id' => 'Venue ID',
        ];
    }

    public function getVenu_relation() {
        return $this->hasOne(Venue::className(), ['id' => 'venue_id']);
    }
}
