<?php

namespace App\Controller;

// Model
use App\Model\DataBase\{
    Order,
    Address,
    OrderItems
};

// Helpers
use App\Helpers\{
    FormHelper as Form,
    RedirectHelper as Redirect,
    SessionHelper as Session
};
use App\Model\DataBase\Product;

class ControllerOrderItems
{
    private $order;
    private $order_items;
    private $product;
    private $address;

    public function __construct()
    {
        $this->order = new Order();
        $this->product = new Product();
        $this->order_items = new OrderItems();
        $this->address = new Address();
    }

    public function displayOrdered()
    {
        $datas = $this->order->getAllOrdered();
        return $datas;
    }

    public function redirectToProfile()
    {
        $order_id = Session::getValue('order_id');
        if (!$order_id && Session::getValue('ordered')) {
            Session::unsetValue('ordered');
            return true;
        } elseif (!$order_id) {
            Redirect::redirectTo(Redirect::HOME_URL);
        } else {
            if (!$this->order_items->getAddressByOrderId($order_id)) {
                Redirect::redirectTo(Redirect::HOME_URL);
            }
        }
        return false;
    }

    public function endOrder()
    {
        if (Form::validates([
            'card_number' => ['min_length' => 19, 'max_length' => 19, 'is_number' => ' '],
            'expiration_month' => ['min_length' => 2, 'max_length' => 2, 'is_number' => true],
            'expiration_year' => ['min_length' => 2, 'max_length' => 2, 'is_number' => true],
            'security_code' => ['min_length' => 3, 'max_length' => 3, 'is_number' => true],
            'name' => ['required' => true, 'max_length' => 50],
        ])) {
            $this->order->updateStatus(Session::getValue('order_id'));
            Session::unsetValue('order_id');

            Session::setValue('ordered', null, true);

            Redirect::redirectTo(Redirect::PAYMENT_URL);
        }
    }

    public function addAddressToOrder()
    {
        $address_valid = Form::validate('address_order', ['is_number' => true, 'max_length' => 10]);
        if ($address_valid) {
            $address = Form::getValue('address_order');
            if ($this->address->existById($address)) {
                $user = Session::getValue('user_id');
                $order = Session::getValue('order_id');
                $this->order->update($user, $address, $order);
                Redirect::redirectTo(Redirect::PAYMENT_URL);
            }
        }
    }

    public function supprFromOrder()
    {
        $quantity_null = Form::getValue('quantity') <= 0;
        $suppr = Form::validate('submit', ['in_array' => ['Supprimer']]);
        $id_valid = Form::validate('product_id', ['required' => true, 'is_number' => true, 'max_length' => 10]);

        if (($quantity_null || $suppr) && $id_valid) {
            $product_id = Form::getValue('product_id');
            $this->order_items->deleteItem($product_id);

            Redirect::redirectTo(Redirect::ORDER_URL);
        }
    }

    public function modifQuantity()
    {
        if (Form::validates([
            'quantity' => ['required' => true, 'is_number' => true, 'max_length' => 10],
            'product_id' => ['required' => true, 'is_number' => true, 'max_length' => 10]
        ])) {
            $order_id = Session::getValue('order_id');
            $product_id = Form::getValue('product_id');
            $quantity = Form::getValue('quantity');

            $this->order_items->updateQuantity($order_id, $product_id, $quantity);

            Redirect::redirectTo(Redirect::ORDER_URL);
        }
    }

    public function affOrder()
    {
        Session::setValue('return_to_url', null, Redirect::ORDER_URL);
        if (!Session::getValue('user_id')) {
            Redirect::redirectTo(Redirect::LOGIN_URL);
        }

        $datas = $this->order_items->getProductByOrderId(Session::getValue('order_id'));
        return $datas;
    }

    public function setSessionOrder()
    {
        $order_id = $this->order->getByUserId(Session::getValue('user_id'));
        Session::setValue('order_id', null, $order_id);
    }

    public function addToOrder()
    {
        $user_id = Session::getValue('user_id');
        $order_id = Session::getValue('order_id');

        $add_order = Form::validate('add_to_order', ['required' => true]) || Session::getValue('pending_order');

        // 
        if (Form::validates([
            'product_id' => ['required' => true, 'is_number' => true, 'max_lenght' => 10],
            'quantity' => ['required' => true, 'is_number' => true, 'positive' => true, 'max_lenght' => 10]
        ])) {
            $product_id = Form::getValue('product_id');
            $quantity = Form::getValue('quantity');
            // If user not signed in 
            if (!$user_id) {
                Session::setValue('order_items', 'product_id', $product_id);
                Session::setValue('order_items', 'quantity', $quantity);
                Session::setValue('pending_order', null, true);
                Session::setValue('return_to_url', null, Redirect::PRODUCT_INFO_URL);
                Redirect::redirectTo(Redirect::LOGIN_URL);
            };
        }

        // Create order if doesn't exist
        if ($add_order && !$order_id) {
            $order_exist = $this->order->getByUserId($user_id);
            if (!$order_exist) {
                $order_id = $this->order->insert($user_id);
            } else {
                $order_id = $order_exist;
            }
            Session::setValue('order_id', null, $order_id);
        }
        Session::unsetValue('pending_order');

        // 
        if ($add_order && $order_id && (isset($product_id) || Session::getValue('order_items'))) {
            if (!isset($product_id)) {
                $product_id = Session::getValue('order_items', 'product_id');
                $quantity = Session::getValue('order_items', 'quantity');
                Session::unsetValue('order_items');
            }

            $item_quantity_in_order = $this->order_items->isItemGetQuantity($product_id, $order_id);

            if ($item_quantity_in_order) { // If item already in order
                $new_quantity = $item_quantity_in_order + $quantity;
                $this->order_items->updateQuantity($order_id, $product_id, $new_quantity);
            } else { // If item not in order 
                $price = $this->product->getPriceById($product_id);
                $this->order_items->insert($order_id, $product_id, $quantity, $price);
            }
        }

        // Refresh
        if ($add_order) {
            Redirect::redirectTo(Redirect::PRODUCT_INFO_URL);
        }
    }
}
