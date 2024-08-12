<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * SignupForm model
 */
class SignupForm extends Model
{
    public $user_name;
    public $user_email;
    public $password;
    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_name', 'user_email', 'password', 'password_repeat'], 'required'],
            ['user_email', 'email'],
            ['user_email', 'unique', 'targetClass' => '\app\models\Users', 'message' => 'This email address has already been taken.'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return Users|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new Users();
        $user->user_name = $this->user_name;
        $user->user_email = $this->user_email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}
