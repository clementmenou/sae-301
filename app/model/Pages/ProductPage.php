<?php

require_once './app/model/Page.php';

class ProductPage extends Page
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
