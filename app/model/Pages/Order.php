<?php

namespace App\Model\Pages;

use App\Model\Page;

class Order extends Page
{
    public function __construct()
    {
        parent::__construct(
            'Panier',
            'order.php',
            ['header.css', 'form.css', 'order.css', 'footer.css'],
            ['order.js'],
            true,
            true
        );
    }
}
