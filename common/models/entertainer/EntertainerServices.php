<?php

namespace common\models\entertainer;
use Yii;

use common\models\Services;

/**
 * This is the model class for table "{{%tbl_entertainer_services}}".
 *
 * @property int $id
 * @property int $party_theme_id
 * @property string $duration
 * @property int $count_of_guests
 * @property double $price
 */
class EntertainerServices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_entertainer_services}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service_id','entertainer_id','extra_guest_count','entertainers_count'], 'integer'],
            [['count_of_guests'], 'string'],
            [['price'], 'number'],
            [['duration'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entertainer' => 'Entertainer',
            'party_theme_rel_id' => 'Party Theme',
            'duration' => 'Duration',
            'count_of_guests' => 'Count of guests',
            'extra_guest_count' => 'Extra Guest count',
            'entertainers_count' => 'Entertainers count',
            'price' => 'Price',
        ];
    }

    public function getService_relation() {
        return $this->hasOne(Services::className(), ['id' => 'service_id']);
    }

    /**
     * gets minimum price of party theme for given entertainer 
     */
    public function getMinimumPrice($entertainerID) {
        return EntertainerServices::find()->where(['entertainer_id'=>$entertainerID])->min('price');
    }

    public static function getServiceDuration($data) {
        $query = "
            SELECT 
                DISTINCT duration
            FROM tbl_entertainer_services entertainer_services 
            JOIN tbl_services services ON entertainer_services.service_id = services.id 
            JOIN tbl_party_theme party_theme ON services.party_theme_id = party_theme.id 
            WHERE services.party_theme_id = ".$data['party_theme_id']." AND entertainer_services.entertainer_id = ".$data['entertainer_id']."
            ORDER BY party_theme.name
        ";
        return Yii::$app->db->createCommand($query)->queryAll();
    }

    public static function getServiceCountOfGuests($data) {
        $query = "
            SELECT 
                DISTINCT count_of_guests
            FROM tbl_entertainer_services entertainer_services 
            JOIN tbl_services services ON entertainer_services.service_id = services.id 
            JOIN tbl_party_theme party_theme ON services.party_theme_id = party_theme.id 
            WHERE services.party_theme_id = ".$data['party_theme_id']." AND entertainer_services.entertainer_id = ".$data['entertainer_id']."
            ORDER BY party_theme.name
        ";
        return Yii::$app->db->createCommand($query)->queryAll();
    }

    public static function getServicePrice($data) {
        $query = "
            SELECT 
                price
            FROM tbl_entertainer_services entertainer_services 
            JOIN tbl_services services ON entertainer_services.service_id = services.id 
            JOIN tbl_party_theme party_theme ON services.party_theme_id = party_theme.id 
            WHERE entertainer_services.entertainer_id = ".$data['entertainer_id']." AND
                  entertainer_services.duration = '".$data['duration']."' AND
                  entertainer_services.count_of_guests = '".$data['guests']."'
            ORDER BY party_theme.name
        ";
        return Yii::$app->db->createCommand($query)->queryOne();
    }

    /**
     * gets service data
     * @param $partyThemeID integer
     * @param $entertainerID integer
     * @return array
     */
    public function getEntertainerServiceData($partyThemeID, $entertainerID, $entertainersCount){
            $query = "
                SELECT
                    entertainer_services.id,
                    services.name AS service_name,
                    entertainer_services.duration,
                    entertainer_services.count_of_guests,
                    services.base_extra_price,
                    entertainer_services.price,
                    entertainer_services.extra_guest_count, 
                    entertainer_services.entertainers_count
                FROM tbl_entertainer_services entertainer_services
                JOIN tbl_services services ON entertainer_services.service_id = services.id
                JOIN tbl_party_theme party_theme ON services.party_theme_id = party_theme.id
                WHERE services.party_theme_id = ".$partyThemeID." AND
                entertainer_services.entertainer_id = ".$entertainerID." AND services.entertainers_number = ".$entertainersCount."
                ORDER BY party_theme.name
            ";
            return Yii::$app->db->createCommand($query)->queryAll();
    }

    /**
     * gets additional service data
     * @param $partyThemeID integer
     * @param $entertainerID integer
     * @return array
     */
    public function getEntertainerAdditionalServiceData($partyThemeID, $entertainerID) {
            $query = "
                SELECT 
                entertainer_services.id AS id,entertainer_id, party_theme_id, service_id
                FROM tbl_entertainer_services entertainer_services 
                JOIN tbl_services services ON entertainer_services.service_id = services.id 
                JOIN tbl_party_theme party_theme ON services.party_theme_id = party_theme.id 
                WHERE services.party_theme_id = ".$partyThemeID." AND entertainer_services.entertainer_id = ".$entertainerID."
                GROUP BY entertainer_id, party_theme_id
                ORDER BY party_theme.name";
            return Yii::$app->db->createCommand($query)->queryAll();
    }

    public function getEntertainerExtraThemesServiceData($entertainerID) {
        $query = "
            SELECT
                entertainer_services.id,
                services.name AS service_name,
                entertainer_services.duration,
                entertainer_services.count_of_guests,
                services.base_extra_price,
                entertainer_services.price,
                entertainer_services.extra_guest_count, 
                entertainer_services.entertainers_count
            FROM tbl_entertainer_services entertainer_services
            JOIN tbl_services services ON entertainer_services.service_id = services.id
            JOIN tbl_party_theme party_theme ON services.party_theme_id = party_theme.id
            WHERE entertainer_services.entertainer_id = ".$entertainerID." AND party_theme.type='extra_services'
            ORDER BY party_theme.name
        ";
        return Yii::$app->db->createCommand($query)->queryAll();
    }

    public function getEntertainerAdditionalProductsServices($entertainerID) {
        $query = "
            SELECT
                entertainer_services.id,
                services.name AS service_name,
                entertainer_services.duration,
                entertainer_services.count_of_guests,
                services.base_extra_price,
                entertainer_services.price,
                entertainer_services.extra_guest_count, 
                entertainer_services.entertainers_count
            FROM tbl_entertainer_services entertainer_services
            JOIN tbl_services services ON entertainer_services.service_id = services.id
            JOIN tbl_party_theme party_theme ON services.party_theme_id = party_theme.id
            WHERE entertainer_services.entertainer_id = ".$entertainerID." AND party_theme.type='additional_products'
            ORDER BY party_theme.name
        ";
        return Yii::$app->db->createCommand($query)->queryAll();
    }
}
