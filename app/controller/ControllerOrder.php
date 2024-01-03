<?php

namespace App\Controller;

// Model
use App\Model\DataBase\Order;

// Helpers
use App\Helpers\{
    FormHelper as Form,
    RedirectHelper as Redirect,
    SessionHelper as Session
};

class ControllerOrder
{
    private $order;

    public function __construct()
    {
        $this->order = new Order();
    }

    public function addToOrder()
    {
        $user_id = Session::getValue('user_id');
        $address_id = Session::getValue('address_id');
        $order_id = Session::getValue('order_id');
        $button_pressed = Form::validate('add_to_order', ['required' => true]);
        if (Form::validate('item_id', [
            'required' => true,
            'is_number' => true,
            'max_lenght' => 10
        ])) {
            $item_id = Form::getValue('item_id');
        }

        if ($button_pressed && $user_id && !$order_id) {
            $order_id = $this->order->insert($user_id, $address_id);
            Session::setValue('order_id', null, $order_id);
        }

        if ($button_pressed && $order_id && $item_id) {
            // fonction ajout d'un item
            // sauvegarde de l'item dans la liste des items du panier sous Session::'list_item_id'
        }
    }
}
