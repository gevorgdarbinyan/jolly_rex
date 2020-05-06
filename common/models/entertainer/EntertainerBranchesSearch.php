<?php

namespace common\models\entertainer;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\entertainer\EntertainerBranches;

/**
 * EntertainerBranchesSearch represents the model behind the search form of `common\models\entertainer\EntertainerBranches`.
 */
class EntertainerBranchesSearch extends EntertainerBranches
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entertainer_id'], 'integer'],
            [['first_line_address', 'post_code', 'area', 'city','note'], 'safe'],
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
        $query = EntertainerBranches::find();

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
        ]);

        $query->andFilterWhere(['like', 'first_line_address', $this->first_line_address])
            ->andFilterWhere(['like', 'post_code', $this->post_code])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'city', $this->city]);

        return $dataProvider;
    }
}
