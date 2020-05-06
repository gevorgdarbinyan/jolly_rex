<?php

namespace common\models\entertainer;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\entertainer\EntertainerOrders;

/**
 * EntertainerOrdersSearch represents the model behind the search form of `common\models\entertainer\EntertainerOrders`.
 */
class EntertainerOrdersSearch extends EntertainerOrders
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entertainer_id', 'order_id', 'party_type_id', 'theme_service_id', 'additional_service_id', 'entertainer_package_id', 'entertainers_count', 'host_child_age', 'customer_id'], 'integer'],
            [['event_date', 'start_time', 'end_time', 'special_requests', 'price_type', 'host_child_gender', 'host_child_name', 'telephone_number', 'venue_address', 'post_code', 'city', 'note', 'entertainer_name', 'message', 'status', 'info_status'], 'safe'],
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
        $query = EntertainerOrders::find();

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
            'order_id' => $this->order_id,
            'party_type_id' => $this->party_type_id,
            'theme_service_id' => $this->theme_service_id,
            'additional_service_id' => $this->additional_service_id,
            'entertainer_package_id' => $this->entertainer_package_id,
            'event_date' => $this->event_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'entertainers_count' => $this->entertainers_count,
            'price' => $this->price,
            'host_child_age' => $this->host_child_age,
            'customer_id' => $this->customer_id,
        ]);

        $query->andFilterWhere(['like', 'special_requests', $this->special_requests])
            ->andFilterWhere(['like', 'price_type', $this->price_type])
            ->andFilterWhere(['like', 'host_child_gender', $this->host_child_gender])
            ->andFilterWhere(['like', 'host_child_name', $this->host_child_name])
            ->andFilterWhere(['like', 'telephone_number', $this->telephone_number])
            ->andFilterWhere(['like', 'venue_address', $this->venue_address])
            ->andFilterWhere(['like', 'post_code', $this->post_code])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'entertainer_name', $this->entertainer_name])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'info_status', $this->info_status]);

        return $dataProvider;
    }
}
