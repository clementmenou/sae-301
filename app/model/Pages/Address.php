<?php

namespace App\Model\Pages;

use App\Model\Page;

class Address extends Page
{
    public function __construct()
    {
        parent::__construct(
            'Adresse',
            'address.php',
            ['header.css', 'address.css', 'footer.css'],
            [],
            true,
            true
        );
    }
}
