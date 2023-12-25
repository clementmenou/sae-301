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

        Session::setValue('login', 'email', Form::getValue('email'));
        Session::setValue('login', 'password', Form::getValue('password'));

        if (Form::validates(['email' => ['required' => true], 'password' => ['required' => true]])) {
            // We only need id and password so
            $user_datas = $this->user->getIdPasswordByEmail(Form::getValue('email'));

            if (!empty($user_datas)) {
                $idDb = $user_datas['user_id'];
                $passwordDb = $user_datas['password'];

                // Update $_SESSION value
                Session::setValue('login', 'wrong_email', false);

                if (password_verify(Form::getValue('password'), $passwordDb)) { // All right
                    // Set user id
                    Session::setValue('user_id', null, $idDb);
                    // Unset login because not necessary anymore
                    Session::unsetValue('login');
                    // Redirect
                    Redirect::redirectTo(Redirect::HOME_URL);
                } else { // Wrong password
                    Session::setValue('login', 'wrong_password', true);
                }
            } else {
                // Wrong email
                Session::setValue('login', 'wrong_email', true);
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
        Session::setValue('signup', 'step', 0, 'if_not_set');
        $step = Session::getValue('signup', 'step');

        $fields = ['first_name', 'last_name', 'username', 'email', 'password', 'confirm_password'];

        foreach ($fields as $field) {
            Session::setValue('signup', $field, Form::getValue($field));
        }

        // Step firstname and lastname
        if (Form::validates(
            [
                'email' => ['required' => true, 'max_length' => 50],
                'password' => ['required' => true, 'max_length' => 50]
            ]
        )) {
            // 
            Session::setValue('signup', 'step', 1);
            // Refresh
            Redirect::redirectTo(Redirect::SIGNUP_URL);
        }

        // Step username and email
        if ($step >= 1 && isset($_POST['username'], $_POST['email'])) {
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
