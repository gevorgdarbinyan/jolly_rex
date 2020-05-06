<?php

namespace common\models\venue;

use Yii;

/**
 * This is the model class for table "{{%tbl_venue_photos}}".
 *
 * @property int $id
 * @property int $venue_id
 * @property string $photo
 * @property string $type
 */
class VenuePhotos extends \yii\db\ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_venue_photos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['venue_id'], 'integer'],
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
            'venue_id' => 'Venue ID',
            'photo' => 'Photo',
            'type' => 'Type',
        ];
    }
}
