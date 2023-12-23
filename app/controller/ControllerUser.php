<?php

require_once './app/model/DataBase/User.php';

class ControllerUser
{
    public $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function loginUser()
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: /');
            exit;
        }

        if (isset($_POST['email'], $_POST['password'])) {
            // We only need id and password so
            $user_datas = $this->user->getIdPasswordByEmail($_POST['email']);

            if (!empty($user_datas)) {
                if ($_POST['password'] == $user_datas['password']) { //password_verify($password, $user_datas['password'])) {
                    // Every thing is right
                    $_SESSION['user_id'] = $user_datas['user_id'];
                    header('Location: /');
                    exit;
                } else {
                    // Wrong password
                    return 'PASSWORD_INCORRECT';
                }
            } else {
                // Wrong email
                return 'EMAIL_INCORRECT';
            }
        }
        return false;
    }
}
