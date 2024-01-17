<?php

namespace App\Model\Pages;

use App\Model\Page;

class Login extends Page
{
    public function __construct()
    {
        parent::__construct(
            'Connectez-vous',
            'login.php',
            ['header.css', 'form.css', 'footer.css'],
            [],
            true,
            true
        );
    }
}
