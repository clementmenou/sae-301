<?php

namespace App\Model\Pages;

use App\Model\Page;

class SignUp extends Page
{
    public function __construct()
    {
        parent::__construct(
            'Sign Up',
            'signup.php',
            ['header.css', 'signup.css', 'footer.css'],
            [],
            true,
            true
        );
    }
}
