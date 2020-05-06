<?php

namespace common\models\entertainer;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\entertainer\EntertainerServices;

/**
 * EntertainerServicesSearch represents the model behind the search form of `app\models\entertainer\EntertainerServices`.
 */
class EntertainerServicesSearch extends EntertainerServices
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entertainer_id', 'service_id', 'count_of_guests','extra_guest_count','entertainers_count'], 'integer'],
            [['duration'], 'safe'],
            [['price'], 'number'],
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
        $query = EntertainerServices::find()->joinWith(['service_relation']);
        
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
            'service_id' => $this->service_id,
            'count_of_guests' => $this->count_of_guests,
            'extra_guest_count' => $this->extra_guest_count,
            'entertainers_count' => $this->entertainers_count,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'duration', $this->duration]);

        return $dataProvider;
    }
}
