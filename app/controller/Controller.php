<?php

require_once './app/model/DataBase/User.php';
require_once './app/model/Page.php';

class Controller
{
    public $users;

    public function __construct()
    {
        $this->users = new User();
    }

    public function home()
    {
        $home = new Page(
            'Home',
            'home.php',
            ['header.css', 'home.css', 'footer.css'],
            ['home.js'],
            true,
            true
        );

        $home->render();
    }

    public function productPage()
    {
        $productPage = new Page(
            'Products',
            'product_page.php',
            ['header.css', 'product_page.css', 'footer.css'],
            ['product_page.js'],
            true,
            true
        );

        $productPage->render();
    }

    public function error404()
    {
        $error404 = new Page(
            'Error 404',
            'error_404.php',
            ['header.css', 'error_404.css', 'footer.css'],
            [],
            true,
            true
        );

        $error404->render();
    }
}
