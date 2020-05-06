<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use common\models\entertainer\EntertainerStaff;
use common\models\entertainer\EntertainerPartyThemes;

/**
 * This is the model class for table "{{%tbl_user}}".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $postal_code
 * @property string $status
 * @property int $user_type_id
 * @property int $support_instant_booking
 * @property int $rating
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $photo;
    public $photos;
    public $party_themes;
    public $user_type_search;
    public $entertainer_name_search;
    public $search_name;
    const STATUS_INACTIVE = 'Inactive';
    const STATUS_ACTIVE = 'Active';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['user_type_id', 'support_instant_booking', 'rating'], 'integer'],
            [['user_type_id', 'rating'], 'integer'],
            [['email'], 'required'],
            [['email'], 'string', 'max' => 200],
            [['password'], 'string', 'max' => 32],
            [['postal_code', 'status'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'status' => 'Status',
            'user_type_id' => 'User Type',
            'rating' => 'Rating',
            'postal_code' => 'Postal Code',
        ];
    }
	
	/**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }
	
	/**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        //return $this->auth_key;
    }
	
	/**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        //return $this->getAuthKey() === $authKey;
    }
	
	/**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return md5($password) == $this->password;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = md5($password);
    }
	
	public function setStatus() {
		$this->status = self::STATUS_ACTIVE;
	}
	
	/**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        //$this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function getUserPhotos_relation() {
        return $this->hasMany(UserPhotos::className(), ['user_id' => 'id']);
    }
    
    public function getUserPhoto_relation() {
        return $this->hasOne(UserPhotos::className(), ['user_id' => 'id']);
    }
    
    public function getUserPartyTheme_relation() {
        return $this->hasMany(EntertainerPartyThemes::className(), ['entertainer_id' => 'id']);
    }
    
    public function getUserPrice_relation() {
        return $this->hasMany(EntertainerServices::className(), ['entertainer_id' => 'id']);
    }

    public static function getEntertainerStaff($userID){
        return EntertainerStaff::find()->where(['user_id'=>$userID])->all();
    }

//    public function getEntertainerRelation(){
//        return $this->hasOne(Entertainer::className(), ['user_id' => 'id']);
//    }
    
    public function getFullName(){
        return $this->first_name .' '.$this->last_name;
    }

    public function getUserTypeUserName($userID) {
        $query = "
            SELECT 
                * 
            FROM tbl_user user
            JOIN tbl_user_types user_types ON user.user_type_id = user_types.id
            WHERE user.id = ".intval($userID)." AND user_types.name NOT IN('Sys Admin')
        ";
        $result = Yii::$app->db->createCommand($query)->queryOne();

        $userType = $result['user_type_name'];

        $userTypeUserData = $namespace = '\frontend\components\\' . $userType . 'Widget';
    }
}
