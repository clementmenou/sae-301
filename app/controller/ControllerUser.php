<?php

namespace App\Controller;

// Model
use App\Model\DataBase\User;

// Helpers
use App\Helpers\{
    FormHelper as Form,
    RedirectHelper as Redirect,
    SessionHelper as Session
};

class ControllerUser
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function loginUser()
    {
        if (Session::getValue('user_id')) {
            Redirect::redirectTo(Redirect::HOME_URL);
        }

        if (Form::validateFields(['email' => ['required' => true], 'password' => ['required' => true]])) {
            $email = Form::getFieldValue('email');
            $password = Form::getFieldValue('password');

            // Save data in $_SESSION
            Session::setValue('login', $email, 'email');
            Session::setValue('login', $password, 'password');

            // We only need id and password so
            $user_datas = $this->user->getIdPasswordByEmail($email);

            if (!empty($user_datas)) {
                // Update $_SESSION value
                Session::setValue('login', false, 'wrong_email');

                if (password_verify($password, $user_datas['password'])) { // All right
                    // Get user id
                    Session::setValue('user_id', $user_datas['user_id']);
                    // Unset login because not necessary anymore
                    Session::unsetValue('login');
                    // Redirect
                    Redirect::redirectTo(Redirect::HOME_URL);
                } else { // Wrong password
                    Session::setValue('login', true, 'wrong_password');
                }
            } else {
                // Wrong email
                Session::setValue('login', true, 'wrong_email');
            }
            // Refresh
            Redirect::redirectTo(Redirect::LOGIN_URL);
        }
    }

    public function signUpUser()
    {
        // Redirect if user loged in
        if (Session::getValue('user_id')) {
            Redirect::redirectTo(Redirect::HOME_URL);
        }

        // Initialize if not set
        $_SESSION['signup']['step'] ??= 0;
        $step = $_SESSION['signup']['step'];

        // Step firstname and lastname
        if (isset($_POST['first_name'], $_POST['last_name'])) {
            // Save input datas
            $_SESSION['signup']['first_name'] = $_POST['first_name'];
            $_SESSION['signup']['last_name'] = $_POST['last_name'];

            // Verify if < 50 caracteres
            if (strlen($_POST['first_name']) < 50 && strlen($_POST['last_name']) < 50)
                $_SESSION['signup']['step'] = 1;

            // Refresh
            Redirect::redirectTo(Redirect::SIGNUP_URL);
        }

        // Step username and email
        if ($step >= 1 && isset($_POST['username'], $_POST['email'])) {
            // Save input datas
            $_SESSION['signup']['username'] = $_POST['username'];
            $_SESSION['signup']['email'] = $_POST['email'];

            // Verify input values
            $_SESSION['signup'] = array_merge($_SESSION['signup'], $this->user->isUserByUsername($_POST['username']));
            $_SESSION['signup'] = array_merge($_SESSION['signup'], $this->user->isUserByEmail($_POST['email']));

            if (!$_SESSION['signup']['username_exists'] && !$_SESSION['signup']['email_exists'])
                $_SESSION['signup']['step'] = 2;

            // Refresh
            Redirect::redirectTo(Redirect::SIGNUP_URL);
        }

        // Step password
        if ($step >= 2 && isset($_POST['password'], $_POST['confirm_password'])) {
            $_SESSION['signup']['password'] = $_POST['password'];
            $_SESSION['signup']['confirm_password'] = $_POST['confirm_password'];

            $complexity =
                preg_match('/[A-Z]/', $_POST['password']) &&
                preg_match('/[a-z]/', $_POST['password']) &&
                preg_match('/[0-9]/', $_POST['password']) &&
                preg_match('/\W/', $_POST['password']);

            $length = strlen($_POST['password']) >= 10;

            if ($_POST['password'] === $_POST['confirm_password'] && $complexity && $length) {
                $_SESSION['signup']['step'] = 3;
            }
        }

        // Final step
        if ($step == 3) {
            $_SESSION['user_id'] = $this->user->insert($_SESSION['signup']);
            unset($_SESSION['signup']);
            Redirect::redirectTo(Redirect::HOME_URL);
        }
    }
}
