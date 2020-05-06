<?php

namespace common\models\entertainer;

use Yii;
use common\models\Entertainer;
use common\models\User;
use common\models\PostalCodes;

/**
 * This is the model class for table "{{%tbl_entertainer_postal_codes}}".
 *
 * @property int $id
 * @property int $entertainer_id
 * @property int $postal_code_id
 * @property int $creator_id
 * @property string $created_date
 */
class EntertainerPostalCodes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_entertainer_postal_codes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entertainer_id', 'postal_code_id'], 'required'],
            [['entertainer_id', 'postal_code_id', 'creator_id'], 'integer'],
            [['created_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entertainer_id' => 'Entertainer ID',
            'postal_code_id' => 'Postal Code',
            'creator_id' => 'Creator ID',
            'created_date' => 'Created Date',
        ];
    }

    public function getEntertainer_relation(){
        return $this->hasOne(Entertainer::className(), ['id' => 'entertainer_id']);
    }

    public function getUser_relation(){
        return $this->hasOne(User::className(), ['id' => 'creator_id']);
    }

    public function getPostalCodes_relation() {
        return $this->hasOne(PostalCodes::className(),['id'=>'postal_code_id']);
    }

    public function getEntertainerPostalCodeData($data) {
        $query = "
            SELECT
                postal_codes.id AS postal_code_id,
                postal_codes.name AS postal_code_name,
                postal_codes.abbr AS postal_code_abbr,
                postal_code_directions.id AS postal_code_direction_id,
                postal_code_directions.name AS postal_code_direction
            FROM tbl_entertainer_postal_codes entertainer_postal_codes
            LEFT JOIN tbl_postal_codes postal_codes ON entertainer_postal_codes.postal_code_id = postal_codes.id
            LEFT JOIN tbl_postal_code_directions postal_code_directions ON postal_codes.postal_code_direction_id = postal_code_directions.id
            WHERE entertainer_postal_codes.entertainer_id = ". intval($data['entertainer_id']);
        return Yii::$app->db->createCommand($query)->queryAll();
    } 
}
