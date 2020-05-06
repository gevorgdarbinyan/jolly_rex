<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_postal_code_directions}}".
 *
 * @property int $id
 * @property string $name
 */
class PostalCodeDirections extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_postal_code_directions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 100],
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
        ];
    }
}
