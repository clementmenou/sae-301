<?php

require_once './app/model/Page.php';

class Login extends Page
{
    public function __construct()
    {
        parent::__construct(
            'Connectez-vous',
            'login.php',
            ['header.css', 'login.css', 'footer.css'],
            [],
            true,
            true
        );
    }
}
