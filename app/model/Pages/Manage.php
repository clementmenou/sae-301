<?php

namespace App\Model\Pages;

use App\Model\Page;

class Manage extends Page
{
    public function __construct()
    {
        parent::__construct(
            'Gérez le site',
            'manage.php',
            ['header.css', 'manage.css', 'footer.css'],
            [],
            true,
            true
        );
    }
}
