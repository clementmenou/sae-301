<?php

namespace App\Model\Pages;

use App\Model\Page;

class ProductList extends Page
{
    public function __construct()
    {
        parent::__construct(
            'Products',
            'product_list.php',
            ['header.css', 'product_list.css', 'footer.css'],
            [],
            true,
            true
        );
    }
}
