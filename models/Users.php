<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Users model
 */
class Users extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_name', 'user_email', 'password', 'auth_key'], 'required'],
            ['user_email', 'email'],
            ['user_email', 'unique'],
        ];
    }

    // Method to find a user by ID (required by IdentityInterface)
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    // Method to find a user by access token (required by IdentityInterface)
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // You can implement this if you use access tokens, otherwise return null
        return null;
    }

    // Method to find a user by email (custom method)
    public static function findByEmail($email)
    {
        return static::findOne(['user_email' => $email]);
    }

    // Method to get the ID of the user (required by IdentityInterface)
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    // Method to get the auth key (required by IdentityInterface)
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    // Method to validate the auth key (required by IdentityInterface)
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    // Method to validate the password
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }


    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    
}
