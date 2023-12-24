<?php

namespace App\Model\Pages;

use App\Model\Page;

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
