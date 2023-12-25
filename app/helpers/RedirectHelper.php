<?php

namespace App\Helpers;

class RedirectHelper
{
    // URL
    public const HOME_URL = '/';
    public const LOGIN_URL = '/connectez_vous';
    public const SIGNUP_URL = '/inscrivez_vous';

    public static function redirectTo($location)
    {
        header("Location: $location");
        exit;
    }
}
