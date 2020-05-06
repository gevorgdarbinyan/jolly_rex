<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class UserSearch extends User {

    public $price_range;
    public $range_from_price;
    public $range_to_price;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'user_type_id'], 'integer'],
            [['price_range'], 'string'],
            [['email','password', 'postal_code', 'status', 'user_type_id', 'support_instant_booking'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        $query = User::find()->JoinWith(['userPhoto_relation', 'userPartyTheme_relation']);
        $userTableName = User::tableName();
        $entertainerServicesTable = \common\models\entertainer\EntertainerServices::tableName();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if ($this->user_type_id == 0) {
            $this->user_type_id = null;
        }

        if ($this->price_range) {
            if (strpos($this->price_range, '-') !== false) {
                $pricesRange = explode('-', $this->price_range);
                $this->range_from_price = $pricesRange[0];
                $this->range_to_price = $pricesRange[1];
            } else {
                $this->range_from_price = $this->price_range;
                $this->range_to_price = false;
            }
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_type_id' => $this->user_type_id,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'password', $this->password])
                ->andFilterWhere(['like', 'postal_code', $this->postal_code])
                ->andFilterWhere(['like', 'status', $this->status]);
        return $dataProvider;
    }

    public function searchForHomepage($data) {
        $provider = new ArrayDataProvider();
        if ($data) {
            $searchData = $data['UserSearch'];
            $searchPattern = $searchData['search_name'];
            $userTypeID = $searchData['user_type_id'];

//            if (!$userTypeID) {
//                $provider = $this->searchVenueEntertainer($searchPattern);
//            } elseif ($userTypeID && $searchPattern) {
//                if ($userTypeID == 2) {
//                    $provider = $this->searchEntertainer($searchPattern);
//                }
//            } else {
//                $provider = $this->searchVenueEntertainer($searchPattern);
//            }
            
            $provider = $this->searchEntertainer($searchPattern);
            
        }
//        else {
//            $provider = $this->searchVenueEntertainer();
//        }
        return $provider;
    }
    
    public function searchVenueEntertainer($searchPattern = '') {
        $entertainerWhereCondition = ($searchPattern) ? " WHERE name LIKE '%$searchPattern%' " : "";
        $homepageEntertainerDataQuery = "
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
                    LEFT JOIN tbl_entertainer_services ON tbl_entertainer.id = tbl_entertainer_services.entertainer_id " .
                $entertainerWhereCondition .
                "
                LIMIT 1
        ";

        $homepageEntertainerData = Yii::$app->db->createCommand($homepageEntertainerDataQuery)->queryAll();

        $venueWhereCondition = ($searchPattern) ? " WHERE name LIKE '%$searchPattern%' " : "";
        $homepageVenueDataQuery = "
            SELECT
                tbl_venue.id AS id,
                tbl_venue.name AS name,
                tbl_venue.short_description AS short_description,
                tbl_venue.description AS description,
                tbl_venue.rating AS rating,
                tbl_venue.price AS price,
                tbl_venue_photos.photo AS photo
                    FROM tbl_venue
                    LEFT JOIN tbl_venue_photos ON tbl_venue.id = tbl_venue_photos.venue_id " .
                $venueWhereCondition .
                "
                LIMIT 1
        ";

        $homepageVenueData = Yii::$app->db->createCommand($homepageVenueDataQuery)->queryAll();

        $arrayData = array_merge($homepageEntertainerData, $homepageVenueData);

        $provider = new ArrayDataProvider([
            'allModels' => $arrayData,
//            'sort' => [
//                'attributes' => ['id', 'username', 'email'],
//            ],
//            'pagination' => [
//                'pageSize' => 10,
//            ],
        ]);
        
        return $provider;
    }
    
    public function searchEntertainer($searchPattern) {
        $entertainerWhereCondition = ($searchPattern) ? " WHERE name LIKE '%$searchPattern%' " : "";
        $homepageEntertainerDataQuery = "
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
                    LEFT JOIN tbl_entertainer_services ON tbl_entertainer.id = tbl_entertainer_services.entertainer_id " .
                $entertainerWhereCondition .
                "
                LIMIT 2
        ";

        $homepageEntertainerData = Yii::$app->db->createCommand($homepageEntertainerDataQuery)->queryAll();
        
        $provider = new ArrayDataProvider([
            'allModels' => $homepageEntertainerData,
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
