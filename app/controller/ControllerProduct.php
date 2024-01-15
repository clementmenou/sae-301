<?php

namespace App\Controller;

// Model
use App\Model\DataBase\{
    Product,
    Category
};

// Helpers
use App\Helpers\{
    FormHelper as Form,
    RedirectHelper as Redirect,
    SessionHelper as Session
};

class ControllerProduct
{
    private $product;
    private $controllerUser;
    private $category;

    public function __construct()
    {
        $this->category = new Category();
        $this->product = new Product();
        $this->controllerUser = new ControllerUser();
    }

    public function productList()
    {
        $data = [];

        $fragrance = Session::getValue('fragrance');
        if ($fragrance == 'base') {
            $data['all_products'] = $this->product->getAllProduct();
        } else {
            $data['all_products'] = $this->product->getProductsByCategory(Session::getValue('fragrance'));
        }

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

    public function addProduct()
    {
        $user_admin = $this->controllerUser->isUserAdmin();
        if (!Session::getValue('user_id') && !$user_admin) {
            Redirect::redirectTo(Redirect::HOME_URL);
        }

        $refresh = false;


        $inputs = ['name', 'description', 'price', 'quantity', 'image'];

        foreach ($inputs as $input) {
            if (Form::validate('insert_' . $input, ['required' => true])) {
                Session::setValue('insert', $input, Form::getValue('insert_' . $input));
                $refresh = true;
            }
        }

        if (Form::validates([
            'insert_name' => ['required' => true, 'max_length' => 50],
            'insert_description' => ['required' => true, 'max_length' => 500],
            'insert_price' => ['required' => true, 'max_length' => 10, 'is_number' => true],
            'insert_quantity' => ['required' => true, 'max_length' => 10, 'is_number' => true],
            'insert_image' => ['required' => true, 'max_length' => 50],
            'insert_category' => ['required' => true, 'is_array_number' => true]
        ])) {
            $form['name'] = Form::getValue('insert_name');

            $name_exists = $this->product->isProductByName($form['name']);

            if (!$name_exists) {
                $form['description'] = Form::getValue('insert_description');
                $form['price'] = Form::getValue('insert_price');
                $form['stock_quantity'] = Form::getValue('insert_quantity');
                $form['image'] = Form::getValue('insert_image');

                $product_id = $this->product->insert($form);

                $form['category'] = Form::getValue('insert_category');
                foreach ($form['category'] as $category_id) {
                    $this->category->insertProductCategory($product_id, $category_id);
                }

                Session::unsetValue('insert');
            } else {
                Session::setValue('insert', 'name_error', true);
            }
        }

        if ($refresh) {
            Redirect::redirectTo(Redirect::MANAGE_URL);
        }

        $datas['insert']['name'] = Session::getValue('insert', 'name', '');
        $datas['insert']['description'] = Session::getValue('insert', 'description', '');
        $datas['insert']['price'] = Session::getValue('insert', 'price', '');
        $datas['insert']['quantity'] = Session::getValue('insert', 'quantity', '');
        $datas['insert']['image'] = Session::getValue('insert', 'image', '');
        $datas['insert']['name_error'] = Session::getValue('insert', 'name_error', false);

        return $datas;
    }

    public function modifProduct()
    {
        $datas = $this->product->getAllNames();

        if (Form::validates([
            'update_name' => ['required' => true, 'max_length' => 50],
            'update_quantity' => ['required' => true, 'max_length' => 50, 'is_number' => true]
        ])) {
            $form['product_id'] = $this->product->getIdByName(Form::getValue('update_name'));
            $form['stock_quantity'] = Form::getValue('update_quantity');
            $this->product->updateQuantity($form);
        }

        return $datas;
    }

    public function supprProduct()
    {
        $datas['liste_name_product'] = $this->product->getAllNames();

        if (Form::validate('delete_name', ['required' => true, 'max_length' => 50])) {
            $product_id = $this->product->getIdByName(Form::getValue('delete_name'));
            $this->product->delete($product_id);
            Redirect::redirectTo(Redirect::MANAGE_URL);
        }
    }
}
