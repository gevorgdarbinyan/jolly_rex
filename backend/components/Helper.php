<?php

namespace backend\components;

use yii\base\Component;
use common\models\PartyTheme;
use common\models\entertainer\EntertainerPartyThemes;
use yii\helpers\ArrayHelper;
use Yii;

class Helper extends Component {

    public function getEntertainerPartyThemes($partyThemeData) {
        $partyThemeArray = PartyTheme::find()->all();
        $entertainerPartyTheme = [];
        $partyThemes = ArrayHelper::map($partyThemeArray, 'id', 'name');
        foreach ($partyThemeData as $partyTheme) {
            $entertainerPartyTheme[] = $partyThemes[$partyTheme->party_theme_id];
        }

        return implode(',<br /> ', $entertainerPartyTheme);
    }

    public function addPartyThemes($partyThemes, $entertainerID) {
        $allPartyThemesData = EntertainerPartyThemes::find()->where(['entertainer_id' => $entertainerID])->asArray()->all();
        $allPartyThemes = ArrayHelper::map($allPartyThemesData, 'id', 'party_theme_id');
        $deleteData = array_diff($allPartyThemes, $partyThemes);
        $insertData = array_diff($partyThemes, $allPartyThemes);

        if ($insertData) {
            foreach ($insertData as $partyTheme) {
                $entertainerPartyThemeModel = new EntertainerPartyThemes();
                $entertainerPartyThemeModel->entertainer_id = $entertainerID;
                $entertainerPartyThemeModel->party_theme_id = $partyTheme;

                $entertainerPartyThemeModel->save();
            }
        }

        if ($deleteData) {
            foreach ($deleteData as $deletePartyTheme) {
                Yii::$app->db
                        ->createCommand()
                        ->delete('tbl_entertainer_party_themes', [
                            'entertainer_id' => $entertainerID,
                            'party_theme_id' => $deletePartyTheme
                        ])
                        ->execute();
            }
        }
    }
    
    public function getYoutubeEmbedUrl($youtubeLink) {
        $youtubeLinkParts = explode('=', $youtubeLink);
        
        $youtubeEmbedUrl = 'https://www.youtube.com/embed/' . $youtubeLinkParts[1];
        
        return $youtubeEmbedUrl;
    }
}
