<?php

namespace App\Model\Pages;

use App\Model\Page;

class ProductInfo extends Page
{
    public function __construct()
    {
        parent::__construct(
            'Products',
            'product_info.php',
            ['header.css', 'product_info.css', 'footer.css'],
            [],
            true,
            true
        );
    }
}
