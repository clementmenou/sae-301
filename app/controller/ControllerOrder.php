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

        if ($user_id) {
            $order_id = $this->order->insert($user_id, $address_id);
            Session::setValue('order_id', null, $order_id);
        }
    }
}
