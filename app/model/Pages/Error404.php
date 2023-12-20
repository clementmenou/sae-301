<?php

require_once './app/model/Page.php';

class Error404 extends Page
{
    public function __construct()
    {
        parent::__construct(
            'Error 404',
            'error_404.php',
            ['header.css', 'error_404.css', 'footer.css'],
            [],
            true,
            true
        );
    }
}
