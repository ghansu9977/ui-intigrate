<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "students".
 *
 * @property int $SID
 * @property string|null $FirstName
 * @property string|null $LastName
 * @property string|null $DOB
 * @property string|null $Gender
 */
class Students extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DOB'], 'safe'],
            [['FirstName', 'LastName'], 'string', 'max' => 50],
            [['Gender'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SID' => 'Sid',
            'FirstName' => 'First Name',
            'LastName' => 'Last Name',
            'DOB' => 'Dob',
            'Gender' => 'Gender',
        ];
    }
}
