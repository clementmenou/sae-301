<?php

namespace App\Model\Pages;

use App\Model\Page;

class Profile extends Page
{
    public function __construct()
    {
        parent::__construct(
            'Profile',
            'profile.php',
            ['header.css', 'form.css', 'profile.css', 'footer.css'],
            [],
            true,
            true
        );
    }
}
