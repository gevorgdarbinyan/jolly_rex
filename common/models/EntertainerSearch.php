<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use common\models\Entertainer;
use common\models\entertainer\EntertainerServices;

/**
 * EntertainerSearch represents the model behind the search form of `common\models\Entertainer`.
 */
class EntertainerSearch extends Entertainer
{
    public $price_range;
    public $range_from_price;
    public $range_to_price;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'support_instant_booking', 'rating','support_mileage'], 'integer'],
            [['name', 'first_name', 'last_name', 'short_description', 'description', 'price_description', 'package_description', 'first_line_address','post_code','area','city','phone_number', 'video','mileage_price'], 'safe'],
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
        $query = Entertainer::find();

        $entertainerServicesTable = EntertainerServices::tableName();

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
            'user_id' => $this->user_id,
            'support_instant_booking' => $this->support_instant_booking,
            'rating' => $this->rating,
        ]);

        $query->andFilterWhere(['like', 'LOWER(name)', strtolower($this->name)])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'price_description', $this->price_description])
            ->andFilterWhere(['like', 'package_description', $this->package_description])
            ->andFilterWhere(['like', 'first_line_address', $this->first_line_address])
            ->andFilterWhere(['like', 'post_code', $this->post_code])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'video', $this->video]);
        if ($this->price_range) {
            if ($this->price_range == 501) {
                $query->andFilterWhere(['>', $entertainerServicesTable . '.price', $this->price_range]);
            } else {
                $pricesArray = explode('-', $this->price_range);
                $query->andFilterWhere(['between', $entertainerServicesTable . '.price', $pricesArray[0], $pricesArray[1]]);
            }
        }
//        if ($this->range_from_price && $this->range_to_price) {
//            $query->andFilterWhere(['between', $entertainerServicesTable . '.price', $this->range_from_price, $this->range_to_price]);
//        } elseif ($this->range_from_price && !$this->range_to_price) {
//            $query->andWhere(['>', $entertainerServicesTable . '.price', $this->range_from_price]);
//        }
        
        return $dataProvider;
    }

    public function searchForHomepage() {

        $query = "
            SELECT
                tbl_entertainer.id AS id,
                tbl_entertainer.name AS name,
                tbl_entertainer.short_description AS short_description,
                tbl_entertainer.description AS description,
                tbl_entertainer.rating AS rating,
                tbl_entertainer_photos.photo AS photo,
                MIN(tbl_entertainer_services.price) AS price
                    FROM tbl_entertainer
                    LEFT JOIN tbl_entertainer_photos ON tbl_entertainer.id = tbl_entertainer_photos.entertainer_id
                    LEFT JOIN tbl_entertainer_services ON tbl_entertainer.id = tbl_entertainer_services.entertainer_id
                LIMIT 1
        ";

        $data = Yii::$app->db->createCommand($query)->queryAll();

        $provider = new ArrayDataProvider([
            'allModels' => $data,
//            'sort' => [
//                'attributes' => ['id', 'username', 'email'],
//            ],
//            'pagination' => [
//                'pageSize' => 10,
//            ],
        ]);

        return $provider;
    }
}
