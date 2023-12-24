<?php

// Controllers datas
require_once './app/controller/ControllerUser.php';
require_once './app/controller/ControllerCategory.php';

// Pages
require_once './app/model/Pages/Home.php';
require_once './app/model/Pages/Products.php';
require_once './app/model/Pages/Login.php';
require_once './app/model/Pages/SignUp.php';
require_once './app/model/Pages/Error404.php';

class ControllerPage
{
    public $category;
    public $users;

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
        $this->users->loginUser();
        $login->datas['email'] = $_SESSION['login']['email'] ?? '';
        $login->datas['password'] = $_SESSION['login']['password'] ?? '';
        $login->datas['wrong_email'] = $_SESSION['login']['wrong_email'] ?? false;
        $login->datas['wrong_password'] = $_SESSION['login']['wrong_password'] ?? false;
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
