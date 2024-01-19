<?php

namespace App\Controller;

// Model
use App\Model\DataBase\{
    User,
    Order
};

// Helpers
use App\Helpers\{
    FormHelper as Form,
    RedirectHelper as Redirect,
    SessionHelper as Session
};

class ControllerProfile
{
    private $user;
    private $order;

    public function __construct()
    {
        $this->user = new User();
        $this->order = new Order();
    }

    public function updateProfile()
    {
        if (Form::validate('first_name', ['required' => true, 'max_length' => 50])) {
            $dataName = 'first_name';
            $dataValue = Form::getValue('first_name');
            $user_id = Session::getValue('user_id');
            $this->user->updateData($dataName, $dataValue, $user_id);
            Redirect::redirectTo(Redirect::PROFILE_URL);
        }

        if (Form::validate('last_name', ['required' => true, 'max_length' => 50])) {
            $dataName = 'last_name';
            $dataValue = Form::getValue('last_name');
            $user_id = Session::getValue('user_id');
            $this->user->updateData($dataName, $dataValue, $user_id);
            Redirect::redirectTo(Redirect::PROFILE_URL);
        }

        if (Form::validate('username', ['required' => true])) {
            $usernameUsed = $this->user->isUserByUsername(Form::getValue('username'));

            $user_username = $this->user->getUsernameById(Session::getValue('user_id'));
            if ($user_username == Form::getValue('username')) {
                $usernameUsed = false;
            }
            Session::setValue('profile', 'username_exists', $usernameUsed);
        }

        if (Form::validate('username', [
            'required' => true,
            'max_length' => 50,
            'not_used' => Session::getValue('profile', 'username_exists')
        ])) {
            $dataName = 'username';
            $dataValue = Form::getValue('username');
            $user_id = Session::getValue('user_id');
            $this->user->updateData($dataName, $dataValue, $user_id);
            Session::unsetValue('profile', 'username_exists');
            Redirect::redirectTo(Redirect::PROFILE_URL);
        }

        if (Form::validate('email', ['required' => true])) {
            $emailUsed = $this->user->isUserByEmail(Form::getValue('email'));

            $user_email = $this->user->getEmailById(Session::getValue('user_id'));
            if ($user_email == Form::getValue('email')) {
                $emailUsed = false;
            }
            Session::setValue('profile', 'email_exists', $emailUsed);
        }

        if (Form::validate('email', [
            'required' => true,
            'max_length' => 50,
            'not_used' => Session::getValue('profile', 'email_exists')
        ])) {
            $dataName = 'email';
            $dataValue = Form::getValue('email');
            $user_id = Session::getValue('user_id');
            $this->user->updateData($dataName, $dataValue, $user_id);
            Session::unsetValue('profile', 'email_exists');
            Redirect::redirectTo(Redirect::PROFILE_URL);
        }

        $data['username_exists'] = Session::getValue('profile', 'username_exists', false);
        $data['email_exists'] = Session::getValue('profile', 'email_exists', false);

        return $data;
    }

    public function affOrdered()
    {
        $datas = $this->order->getOrderedByPlayerId(Session::getValue('user_id'));
        return $datas;
    }
}
