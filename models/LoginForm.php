<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Users;

class LoginForm extends Model
{
    public $user_email;
    public $password;

    private $_user = false;

    public function rules()
    {
        return [
            [['user_email', 'password'], 'required'],
            ['user_email', 'email'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !Yii::$app->security->validatePassword($this->password, $user->password)) {
                $this->addError($attribute, 'Incorrect email or password.');
            }
        }
    }

    public function login()
{
    if ($this->validate()) {
        $user = $this->getUser();
        if ($user && $user->validatePassword($this->password)) {  
            Yii::$app->user->login($user);

            // Generate JWT token
            $token = $user->generateJwtToken();

            return [
                'user' => $user,
                'token' => $token
            ];
        }
    }

    return false;
}

    protected function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Users::findOne(['user_email' => $this->user_email]);
        }

        return $this->_user;
    }
}

