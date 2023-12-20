<?php

require_once './app/model/Page.php';

class Home extends Page
{
    public function __construct()
    {
        parent::__construct(
            'Home',
            'home.php',
            ['header.css', 'home.css', 'footer.css'],
            ['home.js'],
            true,
            true
        );
    }
}
