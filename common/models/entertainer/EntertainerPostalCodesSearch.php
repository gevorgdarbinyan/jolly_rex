<?php

namespace common\models\entertainer;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\entertainer\EntertainerPostalCodes;

/**
 * EntertainerPostalCodesSearch represents the model behind the search form of `common\models\EntertainerPostalCodes`.
 */
class EntertainerPostalCodesSearch extends EntertainerPostalCodes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entertainer_id', 'postal_code_id', 'creator_id'], 'integer'],
            [['created_date'], 'safe'],
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
        $query = EntertainerPostalCodes::find();

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
            'postal_code_id' => $this->postal_code_id,
            'creator_id' => $this->creator_id,
            'created_date' => $this->created_date,
        ]);

        return $dataProvider;
    }
}
