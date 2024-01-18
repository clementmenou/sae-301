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
            ['header.css', 'form.css', 'address.css', 'footer.css'],
            ['address.js'],
            true,
            true
        );
    }
}
