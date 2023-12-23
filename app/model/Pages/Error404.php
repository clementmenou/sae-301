<?php

require_once './app/model/Page.php';

class Error404 extends Page
{
    public function __construct()
    {
        parent::__construct(
            'Error 404',
            'error404.php',
            ['header.css', 'error404.css', 'footer.css'],
            [],
            true,
            true
        );
    }
}
