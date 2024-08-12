<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teachers".
 *
 * @property int $TeacherID
 * @property string|null $FirstName
 * @property string|null $LastName
 * @property string $Subject
 * @property string|null $HireDate
 */
class Teachers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teachers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Subject','FirstName','LastName','HireDate'], 'required'],
            [['HireDate'], 'safe'],
            [['FirstName', 'LastName'], 'string', 'max' => 50],
            [['Subject'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TeacherID' => 'Teacher ID',
            'FirstName' => 'First Name',
            'LastName' => 'Last Name',
            'Subject' => 'Subject',
            'HireDate' => 'Hire Date',
        ];
    }
}
