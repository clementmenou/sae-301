<?php

namespace App\Model\Pages;

use App\Model\Page;

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
