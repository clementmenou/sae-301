<?php

namespace App\Controller;

// Controllers datas
use App\Controller\{
    ControllerCategory,
    ControllerProduct,
    ControllerUser,
    ControllerOrderItems,
    ControllerReview
};

// Pages
use App\Model\Pages\{
    Home,
    ProductList,
    ProductInfo,
    Login,
    SignUp,
    Profile,
    Error404,
    Manage,
    Order,
    Address,
    Payment
};

class ControllerPage
{
    private $category;
    private $users;
    private $products;
    private $order_items;
    private $review;
    private $address;

    public function __construct()
    {
        $this->category = new ControllerCategory();
        $this->products = new ControllerProduct();
        $this->users = new ControllerUser();
        $this->order_items = new ControllerOrderItems();
        $this->review = new ControllerReview();
        $this->address = new ControllerAddress();
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
        $product_info->datas = $this->products->productInfo();

        $this->order_items->addToOrder();

        $this->review->addReview();
        $this->review->modifReview();
        $this->review->supprReview();
        $this->review->redirectReview();
        $product_info->datas['all_reviews'] = $this->review->displayReviews();

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

    public function profile()
    {
        $profile = new Profile();
        $profile->datas = $this->users->displayUser();
        $profile->render();
    }

    public function manage()
    {
        $manage = new Manage();
        $manage->datas = $this->products->addProduct();
        $manage->datas['liste_name_product'] = $this->products->modifProduct();
        $this->products->supprProduct();
        $manage->render();
    }

    public function order()
    {
        $order = new Order();
        $order->datas['order_items'] = $this->order_items->affOrder();
        $this->order_items->supprFromOrder();
        $this->order_items->modifQuantity();
        $order->render();
    }

    public function address()
    {
        $address = new Address();
        $this->order_items->addAddressToOrder();
        $address->datas = $this->address->addAddress();
        $address->datas['user_addresses'] = $this->address->affAddresses();
        $this->address->supprAddress();
        $this->address->modifAddress();
        $address->render();
    }

    public function payment()
    {
        $payment = new Payment();
        $payment->render();
    }

    public function error404()
    {
        $error404 = new Error404();
        $error404->render();
    }
}
