<?php

namespace common\models\entertainer;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\entertainer\EntertainerPackages;

/**
 * EntertainerPackagesSearch represents the model behind the search form of `common\models\EntertainerPackages`.
 */
class EntertainerPackagesSearch extends EntertainerPackages
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entertainer_id'], 'integer'],
            [['name'], 'safe'],
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
        $query = EntertainerPackages::find();

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
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
