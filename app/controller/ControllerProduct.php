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

    public function redirectToProductInfo()
    {
        if (Form::validate('product_id', ['required' => true, 'is_number' => true, 'max_length' => 10])) {
            Session::setValue('product_info_id', null, Form::getValue('product_id'));
            Redirect::redirectTo(Redirect::PRODUCT_INFO_URL);
        }
    }

    public function productInfo()
    {
        $data = [];
        $data = $this->product->getById(Session::getValue('product_info_id'));
        return $data;
    }
}
