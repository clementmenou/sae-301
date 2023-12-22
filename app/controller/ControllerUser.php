<?php

require_once './app/model/DataBase/User.php';

class ControllerUser
{
    public $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function loginUser($email, $password)
    {
        if (isset($email, $password)) {
            $user_datas = $this->user->getUserByEmail($email);

            if (!empty($user_datas)) {
            }
        }
    }
}
