<?php

require_once './app/model/Page.php';

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
