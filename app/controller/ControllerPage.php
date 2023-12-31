<?php

namespace App\Controller;

// Controllers datas
use App\Controller\{
    ControllerCategory,
    ControllerUser
};
use App\Model\DataBase\Product;
// Pages
use App\Model\Pages\{
    Home,
    ProductList,
    Login,
    SignUp,
    Error404
};

class ControllerPage
{
    private $category;
    private $users;
    private $products;

    public function __construct()
    {
        $this->category = new ControllerCategory();
        $this->products = new ControllerProduct();
        $this->users = new ControllerUser();
    }

    public function home()
    {
        $home = new Home();
        $this->category->homeFilter();
        $home->render();
    }

    public function product_list()
    {
        $product_list = new ProductList();
        $product_list->datas = $this->products->productList();
        $product_list->render();
    }

    public function login()
    {
        $login = new Login();
        $login->datas = $this->users->login();
        $login->render();
    }

    public function signup()
    {
        $signup = new SignUp();
        $signup->datas = $this->users->signUp();
        $signup->render();
    }

    public function error404()
    {
        $error404 = new Error404();
        $error404->render();
    }
}
