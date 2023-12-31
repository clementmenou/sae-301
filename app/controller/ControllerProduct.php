<?php

namespace App\Controller;

// Model
use App\Model\DataBase\Product;

// Helpers
use App\Helpers\{
    FormHelper as Form,
    RedirectHelper as Redirect,
    SessionHelper as Session
};

class ControllerProduct
{
    private $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function productList()
    {
        $data = [];
        $data['all_products'] = $this->product->getProductsByCategory(Session::getValue('fragrance'));
        return $data;
    }
}
