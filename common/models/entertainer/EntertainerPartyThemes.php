<?php

namespace common\models\entertainer;

use Yii;
use common\models\Entertainer;
use common\models\PartyTheme;

/**
 * This is the model class for table "{{%tbl_entertainer_party_themes}}".
 *
 * @property int $id
 * @property int $entertainer_id
 * @property int $party_theme_id
 */
class EntertainerPartyThemes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_entertainer_party_themes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entertainer_id', 'party_theme_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entertainer_id' => 'Entertainer',
            'party_theme_id' => 'Party Theme',
        ];
    }

    public function getEntertainer_relation(){
        return $this->hasOne(Entertainer::className(), ['id' => 'entertainer_id']);
    }

    public function getPartyTheme_relation() {
        return $this->hasOne(PartyTheme::className(),['id'=>'party_theme_id']);
    }

    /**
     * gets list of party themes for the given entertainer 
     */
    public function getPartyThemeList($id){
        $entertainerPartyThemesData = EntertainerPartyThemes::find()
                ->select([
                    'tbl_party_theme.id',
                    'tbl_entertainer_party_themes.entertainer_id',
                    'tbl_entertainer_party_themes.party_theme_id',
                    'tbl_party_theme.name'
                ])
                ->leftJoin('tbl_party_theme', 'tbl_party_theme.id = tbl_entertainer_party_themes.party_theme_id')
                ->where(['tbl_entertainer_party_themes.entertainer_id'=>$id])
                ->asArray()
                ->all();
        return implode(', ', yii\helpers\ArrayHelper::map($entertainerPartyThemesData, 'id', 'name'));
    }
    
}
