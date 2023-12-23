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
        $login->datas['email'] = isset($_POST['email']) ? $_POST['email'] : '';
        $login->datas['password'] = isset($_POST['password']) ? $_POST['password'] : '';
        $login->datas['login_status'] = $this->users->loginUser();
        $login->render();
    }

    public function signup()
    {
    }

    public function error404()
    {
        $error404 = new Error404();
        $error404->render();
    }
}
