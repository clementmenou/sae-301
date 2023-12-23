<?php

// Database
require_once './app/controller/ControllerUser.php';

// Pages
require_once './app/model/Pages/Home.php';
require_once './app/model/Pages/Products.php';
require_once './app/model/Pages/Login.php';
require_once './app/model/Pages/SignUp.php';
require_once './app/model/Pages/Error404.php';

class ControllerPage
{
    public $users;

    public function __construct()
    {
        $this->users = new ControllerUser();
    }

    public function home()
    {
        $home = new Home();
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
        $login->datas['email'] = $_POST['email'] ?? '';
        $login->datas['password'] = $_POST['password'] ?? '';
        $login->datas['login_status'] = $this->users->loginUser();
        $login->render();
    }

    public function signup()
    {
        $signup = new SignUp();
        $this->users->signUpUser();
        $signup->datas['first_name'] = $_SESSION['signup']['first_name'] ?? '';
        $signup->datas['last_name'] = $_SESSION['signup']['last_name'] ?? '';
        $signup->datas['username'] = $_SESSION['signup']['username'] ?? '';
        $signup->datas['email'] = $_SESSION['signup']['email'] ?? '';
        $signup->datas['password'] = $_SESSION['signup']['password'] ?? '';
        $signup->datas['confirm_password'] = $_SESSION['signup']['confirm_password'] ?? '';
        $signup->datas['username_exists'] = $_SESSION['signup']['username_exists'] ?? false;
        $signup->datas['email_exists'] = $_SESSION['signup']['email_exists'] ?? false;
        $signup->render();
    }

    public function error404()
    {
        $error404 = new Error404();
        $error404->render();
    }
}
