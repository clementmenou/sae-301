<?php

namespace App\Model\Pages;

use App\Model\Page;

class Payment extends Page
{
    public function __construct()
    {
        parent::__construct(
            'Payment',
            'payment.php',
            ['header.css', 'form.css', 'footer.css'],
            [],
            true,
            true
        );
    }
}
