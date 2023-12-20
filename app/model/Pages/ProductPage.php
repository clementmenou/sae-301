<?php

require_once './app/model/Page.php';

class ProductPage extends Page
{
    public function __construct()
    {
        parent::__construct(
            'Products',
            'product_page.php',
            ['header.css', 'product_page.css', 'footer.css'],
            ['product_page.js'],
            true,
            true
        );
    }
}
