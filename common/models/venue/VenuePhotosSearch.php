<?php

namespace common\models\venue;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\venue\VenuePhotos;

/**
 * VenuePhotosSearch represents the model behind the search form of `common\models\venue\VenuePhotos`.
 */
class VenuePhotosSearch extends VenuePhotos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'venue_id'], 'integer'],
            [['photo', 'type'], 'safe'],
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
        $query = VenuePhotos::find();

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
            'venue_id' => $this->venue_id,
        ]);

        $query->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
