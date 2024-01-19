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

        if (Form::validate('price_asc', ['required' => true])) {
            Session::setValue('sorting', null, 'price asc');
            Redirect::redirectTo(Redirect::PRODUCT_LIST_URL);
        }
        if (Form::validate('price_desc', ['required' => true])) {
            Session::setValue('sorting', null, 'price desc');
            Redirect::redirectTo(Redirect::PRODUCT_LIST_URL);
        }
        if (Form::validate('quantity_asc', ['required' => true])) {
            Session::setValue('sorting', null, 'quantity asc');
            Redirect::redirectTo(Redirect::PRODUCT_LIST_URL);
        }
        if (Form::validate('quantity_desc', ['required' => true])) {
            Session::setValue('sorting', null, 'quantity desc');
            Redirect::redirectTo(Redirect::PRODUCT_LIST_URL);
        }
        if (Form::validate('promo_asc', ['required' => true])) {
            Session::unsetValue('sorting');
            Session::setValue('sorting', 'promo', 'promo asc');
            Redirect::redirectTo(Redirect::PRODUCT_LIST_URL);
        }
        if (Form::validate('promo_desc', ['required' => true])) {
            Session::unsetValue('sorting');
            Session::setValue('sorting', 'promo', 'promo desc');
            Redirect::redirectTo(Redirect::PRODUCT_LIST_URL);
        }

        if ($fragrance == 'base') {
            if (Session::getValue('sorting', 'promo')) {
                $data['all_products'] = $this->product->getAllProductPromoBy(Session::getValue('sorting', 'promo'));
            } else {
                $data['all_products'] = $this->product->getAllProduct(Session::getValue('sorting', null, 'price desc'));
            }
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
        if (!Session::getValue('user_id') || !Session::getValue('is_admin')) {
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
            'insert_category' => ['required' => true, 'is_array_number' => true],
            'insert_image' => ['image' => true]
        ])) {
            $form['name'] = Form::getValue('insert_name');

            $name_exists = $this->product->isProductByName($form['name']);

            if (!$name_exists) {
                $form['description'] = Form::getValue('insert_description');
                $form['price'] = Form::getValue('insert_price');
                $form['stock_quantity'] = Form::getValue('insert_quantity');

                $img_name = strtolower($form['name']);
                $img_name = str_replace(' ', '-', $img_name);
                $img_name = preg_replace('/[^a-z0-9\-]/', '', $img_name);
                $img_name .= '.' . strtolower(pathinfo($_FILES["insert_image"]["name"])["extension"]);
                $form['image'] = $img_name;

                $product_id = $this->product->insert($form);

                // image process
                $url_upload = 'Public/Images/Products/' . $img_name;
                move_uploaded_file($_FILES["insert_image"]["tmp_name"], $url_upload);

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
        $datas = $this->product->getAllProduct('price asc');

        if (Form::validates([
            'update_name' => ['required' => true, 'max_length' => 50, 'is_number' => true],
            'update_quantity' => ['required' => true, 'max_length' => 50, 'is_number' => true]
        ])) {
            $form['product_id'] = Form::getValue('update_name');
            $form['stock_quantity'] = Form::getValue('update_quantity');
            $this->product->updateQuantity($form);

            Redirect::redirectTo(Redirect::MANAGE_URL);
        }

        return $datas;
    }

    public function supprProduct()
    {
        if (Form::validate('delete_name', ['required' => true, 'max_length' => 50, 'is_number' => true])) {
            $product_id = Form::getValue('delete_name');

            $img_name = $this->product->getImgById($product_id);
            $url_img = 'Public/Images/Products/' . $img_name;
            unlink($url_img);

            $this->product->delete($product_id);
            Redirect::redirectTo(Redirect::MANAGE_URL);
        }
    }
}
