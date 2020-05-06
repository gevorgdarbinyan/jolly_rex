<?php

namespace common\models\entertainer;

use Yii;

/**
 * This is the model class for table "{{%tbl_entertainer_photos}}".
 *
 * @property int $id
 * @property int $entertainer_id
 * @property string $photo
 * @property string $type
 */
class EntertainerPhotos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_entertainer_photos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entertainer_id'], 'integer'],
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
            'entertainer_id' => 'Entertainer ID',
            'photo' => 'Photo',
            'type' => 'Type',
        ];
    }
}
