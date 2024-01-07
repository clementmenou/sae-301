<?php

namespace App\Controller;

// Controllers datas
use App\Controller\{
    ControllerCategory,
    ControllerProduct,
    ControllerUser,
    ControllerOrderItems
};

// Pages
use App\Model\Pages\{
    Home,
    ProductList,
    ProductInfo,
    Login,
    SignUp,
    Error404
};

class ControllerPage
{
    private $category;
    private $users;
    private $products;
    private $order_items;

    public function __construct()
    {
        $this->category = new ControllerCategory();
        $this->products = new ControllerProduct();
        $this->users = new ControllerUser();
        $this->order_items = new ControllerOrderItems();
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
        $this->products->redirectToProductInfo();
        $product_list->render();
    }

    public function product_info()
    {
        $product_info = new ProductInfo();
        $this->order_items->addToOrder();
        $product_info->render();
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
