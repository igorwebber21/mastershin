<?php


namespace app\models\admin;


use RedBeanPHP\R;

class User extends \app\models\User {

    public $attributes = [
        'id' => '',
        'password' => '',
        'fname' => '',
        'lname' => '',
        'login' => '',
        'birthday' => '',
        'email' => '',
        'phone' => '',
        'address' => '',
        'ip_address' => '',
        'ip_location' => '',
        'role' => ''
    ];

    public $rules = [
        'required' => [
            ['fname'],
            ['email'],
            ['role'],
        ],
        'email' => [
            ['email'],
        ],
    ];

    public function checkUnique()
    {
        $user = R::findOne('user', '(email = ?) AND id <> ?', [$this->attributes['email'], $this->attributes['id']]);
        if($user){
            if($user->email == $this->attributes['email']){
                $this->errors['unique'][] = 'Этот email уже занят';
            }
            return false;
        }
        return true;
    }

    public function checkUserAuth()
    {
        $user = R::findOne('user', "id = ?", [$this->attributes['id']]);

        if($user)
        {
            if(password_verify($this->attributes['password'], $user->password))
            {
                return true;
            }
        }

        return false;
    }



    public function getUserData($email)
    {
        $userData = R::getRow('SELECT * FROM user WHERE email = ?', [$email]);
        return $userData;
    }

    public function updateUserPassword()
    {
        $user = R::exec('UPDATE user SET password = ? WHERE id = ?', [$this->attributes['password'], $this->attributes['id']]);
        return $user ? true : false;
    }

}