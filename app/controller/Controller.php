<?php

require_once './app/model/DataBase/User.php';
require_once './app/model/Pages/Home.php';
require_once './app/model/Pages/ProductPage.php';
require_once './app/model/Pages/Error404.php';

class Controller
{
    public $users;

    public function __construct()
    {
        $this->users = new User();
    }

    public function home()
    {
        $home = new Home();

        $home->render();
    }

    public function productPage()
    {
        $productPage = new ProductPage();

        $productPage->render();
    }

    public function error404()
    {
        $error404 = new Error404();

        $error404->render();
    }
}
