<?php

namespace App\Controller;

// Model
use App\Model\DataBase\Order;
use App\Model\DataBase\OrderItems;

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

    public function __construct()
    {
        $this->order = new Order();
        $this->product = new Product();
        $this->order_items = new OrderItems();
    }

    public function addToOrder()
    {
        $user_id = Session::getValue('user_id');
        $address_id = Session::getValue('address_id');
        $order_id = Session::getValue('order_id');
        $add_pressed = Form::validate('add_to_order', ['required' => true]);

        if (Form::validates([
            'product_id' => ['required' => true, 'is_number' => true, 'max_lenght' => 10],
            'quantity' => ['required' => true, 'is_number' => true, 'max_lenght' => 10]
        ])) {
            $product_id = Form::getValue('product_id');
            $quantity = Form::getValue('quantity');
        }

        // Create order if doesn't exist
        if ($add_pressed && $user_id && !$order_id) {
            $order_id = $this->order->insert($user_id, $address_id);
            Session::setValue('order_id', null, $order_id);
        }


        if ($add_pressed && $order_id && isset($product_id)) {
            $item_quantity_in_order = $this->order_items->isItemGetQuantity($product_id);
            if ($item_quantity_in_order) { // If item already in order
                $new_quantity = $item_quantity_in_order + $quantity;
                $this->order_items->updateQuantity($order_id, $product_id, $new_quantity);
            } else { // If item not in order 
                $price = $this->product->getPriceById($product_id);
                $this->order_items->insert($order_id, $product_id, $quantity, $price);
                Session::setValue('list_order_items_id', null, $product_id);
            }

            Redirect::redirectTo(Redirect::PRODUCT_LIST_URL);
        }
    }
}
