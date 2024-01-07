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

    public function login()
    {
        if (Session::getValue('user_id')) {
            Redirect::redirectTo(Redirect::HOME_URL);
        }

        if (Form::validates([
            'email' => ['required' => true],
            'password' => ['required' => true]
        ])) {
            Session::setValue('login', 'email', Form::getValue('email'));
            Session::setValue('login', 'password', Form::getValue('password'));
        }

        if (Form::validates([
            'email' => ['required' => true, 'max_length' => 50],
            'password' => ['required' => true, 'max_length' => 50]
        ])) {
            // Only need id and password
            $user_datas = $this->user->getIdPasswordByEmail(Form::getValue('email'));

            if (!empty($user_datas)) {
                // Update $_SESSION value
                Session::setValue('login', 'wrong_email', false);

                if (password_verify(Form::getValue('password'), $user_datas['password'])) { // All right
                    // Set user id
                    Session::setValue('user_id', null, $user_datas['user_id']);
                    // Unset login because not necessary anymore
                    Session::unsetValue('login');
                    // Redirect to home or specific URL if set
                    Redirect::redirectTo(Session::getValue('return_to_url', null, Redirect::HOME_URL));
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

        // datas to return

        $data = [];

        $data['email'] = Session::getValue('login', 'email', '');
        $data['password'] = Session::getValue('login', 'password', '');
        $data['wrong_email'] = Session::getValue('login', 'wrong_email', false);
        $data['wrong_password'] = Session::getValue('login', 'wrong_password', false);

        return $data;
    }

    public function signUp()
    {
        // Redirect if user loged in
        if (Session::getValue('user_id')) {
            Redirect::redirectTo(Redirect::HOME_URL);
        }

        $refresh = false;

        // Initialize if not set
        Session::setValue('signup', 'step', 0, 'if_not_set');
        $step = Session::getValue('signup', 'step');

        // Save inputs values
        $fields = ['first_name', 'last_name', 'username', 'email', 'password', 'confirm_password'];
        foreach ($fields as $field) {
            if (Form::validate($field, ['required' => true])) {
                Session::setValue('signup', $field, Form::getValue($field));
                $refresh = true;
            }
        }

        // Save error values
        if (Form::validates(['username' => ['required' => true], 'email' => ['required' => true]])) {
            $usernameUsed = $this->user->isUserByUsername(Form::getValue('username'));
            $emailUsed = $this->user->isUserByEmail(Form::getValue('email'));
            Session::setValue('signup', 'username_exists', $usernameUsed);
            Session::setValue('signup', 'email_exists', $emailUsed);
        }

        // Step firstname and lastname
        if (Form::validates([
            'first_name' => ['required' => true, 'max_length' => 50],
            'last_name' => ['required' => true, 'max_length' => 50]
        ])) {
            // Update step
            Session::setValue('signup', 'step', 1);
        }

        // Step username and email
        if ($step >= 1 && Form::validates([
            'username' => [
                'required' => true,
                'max_length' => 50,
                'not_used' => Session::getValue('signup', 'username_exists')
            ],
            'email' => [
                'required' => true,
                'max_length' => 50,
                'not_used' => Session::getValue('signup', 'email_exists')
            ]
        ])) {
            // Update step
            Session::setValue('signup', 'step', 2);
        }

        // Step password
        if ($step >= 2 && Form::validate('password', [
            'min_length' => 10,
            'max_length' => 50,
            'complexity' => true,
            'match' => 'confirm_password'
        ])) {
            // Update step
            Session::setValue('signup', 'step', 3);
        }

        // Refresh
        if ($refresh) {
            Redirect::redirectTo(Redirect::SIGNUP_URL);
        }

        // Final step
        if ($step == 3) {
            // Save id in session
            $id = $this->user->insert(Session::getValue('signup')); // insert and return id
            Session::setValue('user_id', null, $id);

            // Clean sessions used
            Session::unsetValue('signup');

            // Redirect
            Redirect::redirectTo(Session::getValue('return_to_url', null, Redirect::HOME_URL));
        }

        // datas to return
        $data = [];

        $fields = ['first_name', 'last_name', 'username', 'email', 'password', 'confirm_password'];
        foreach ($fields as $field) {
            $data[$field] = Session::getValue('signup', $field, '');
        }

        $data['username_exists'] = Session::getValue('signup', 'username_exists', false);
        $data['email_exists'] = Session::getValue('signup', 'email_exists', false);

        return $data;
    }

    public function logout()
    {
        $fragrance = Session::getValue('fragrance');

        session_unset();

        Session::setValue('fragrance', null, $fragrance);

        Redirect::redirectTo(Redirect::HOME_URL);
    }
}
