<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_service}}".
 *
 * @property int $id
 * @property int $party_theme_id
 * @property string $name
 * @property double $base_extra_price
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_services}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['party_theme_id'], 'integer'],
            [['name'], 'string'],
            [['base_extra_price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'party_theme_id' => 'Party Theme',
            'name' => 'Name',
            'base_extra_price' => 'Base Extra Price',
        ];
    }

    public function getPartyTheme_relation() {
        return $this->hasOne(PartyTheme::className(), ['id' => 'party_theme_id']);
    }
}
