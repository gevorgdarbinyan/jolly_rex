<?php

namespace common\models\entertainer;

use Yii;

/**
 * This is the model class for table "{{%tbl_entertainer_branches}}".
 *
 * @property int $id
 * @property string $first_line_address
 * @property string $post_code
 * @property string $area
 * @property string $city
 * @property string $note
 * @property int $entertainer_id
 */
class EntertainerBranches extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_entertainer_branches}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_line_address', 'area', 'city','note'], 'string'],
            [['entertainer_id'], 'integer'],
            [['post_code'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_line_address' => 'First Line Address',
            'post_code' => 'Post Code',
            'area' => 'Area',
            'city' => 'City',
            'note' => 'Note',
            'entertainer_id' => 'Entertainer'
        ];
    }

    public function getBranchNames(){
        return $this->area.', '.$this->city;
    }
}
