<?php

namespace common\models\entertainer;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\entertainer\EntertainerPartyThemes;

/**
 * EntertainerPatyThemesSearch represents the model behind the search form of `common\models\EntertainerPartyThemes`.
 */
class EntertainerPartyThemesSearch extends EntertainerPartyThemes
{
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
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = EntertainerPartyThemes::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'entertainer_id' => $this->entertainer_id,
            'party_theme_id' => $this->party_theme_id,
        ]);

        return $dataProvider;
    }
}
