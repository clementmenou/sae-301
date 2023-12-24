<?php

namespace App\Model\Pages;

use App\Model\Page;

class Products extends Page
{
    public function __construct()
    {
        parent::__construct(
            'Products',
            'products.php',
            ['header.css', 'products.css', 'footer.css'],
            [],
            true,
            true
        );
    }
}
