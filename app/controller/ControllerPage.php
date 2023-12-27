<?php

namespace App\Controller;

// Controllers datas
use App\Controller\{
    ControllerCategory,
    ControllerUser
};

// Helpers
use App\Helpers\{
    FormHelper as Form,
    RedirectHelper as Redirect,
    SessionHelper as Session
};

// Pages
use App\Model\Pages\{
    Home,
    Products,
    Login,
    SignUp,
    Error404
};

class ControllerPage
{
    private $category;
    private $users;

    public function __construct()
    {
        $this->category = new ControllerCategory();
        $this->users = new ControllerUser();
    }

    public function home()
    {
        $home = new Home();
        $this->category->homeFilter();
        $home->render();
    }

    public function products()
    {
        $products = new Products();
        $products->render();
    }

    public function login()
    {
        $login = new Login();
        $this->users->login();
        $login->datas['email'] = Session::getValue('login', 'email', '');
        $login->datas['password'] = Session::getValue('login', 'password', '');
        $login->datas['wrong_email'] = Session::getValue('login', 'wrong_email', false);
        $login->datas['wrong_password'] = Session::getValue('login', 'wrong_password', false);
        $login->render();
    }

    public function signup()
    {
        $signup = new SignUp();
        $this->users->signUp();
        $signup->datas['first_name'] = Session::getValue('signup', 'first_name', '');
        $signup->datas['last_name'] = Session::getValue('signup', 'last_name', '');
        $signup->datas['username'] = Session::getValue('signup', 'username', '');
        $signup->datas['email'] = Session::getValue('signup', 'email', '');
        $signup->datas['password'] = Session::getValue('signup', 'password', '');
        $signup->datas['confirm_password'] = Session::getValue('signup', 'confirm_password', '');
        $signup->datas['username_exists'] = Session::getValue('signup', 'username_exists', false);
        $signup->datas['email_exists'] = Session::getValue('signup', 'email_exists', false);
        $signup->render();
    }

    public function error404()
    {
        $error404 = new Error404();
        $error404->render();
    }
}
