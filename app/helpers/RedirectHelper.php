<?php

namespace App\Helpers;

class RedirectHelper
{
    public static function redirectTo($location)
    {
        header("Location: $location");
        exit;
    }
}
