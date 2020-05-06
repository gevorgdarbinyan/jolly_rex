<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_postal_codes}}".
 *
 * @property int $id
 * @property string $abbr
 * @property string $name
 * @property int $postal_code_direction_id
 */
class PostalCodes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_postal_codes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['postal_code_direction_id'], 'integer'],
            [['abbr'], 'string', 'max' => 5],
            [['name'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'abbr' => 'Abbr',
            'name' => 'Name',
            'postal_code_direction_id' => 'Postal Code Direction ID',
        ];
    }
}
