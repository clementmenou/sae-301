<?php

namespace App\Helpers;

class SessionHelper
{
    public static function setSessionValue($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function getSessionValue($key)
    {
        return $_SESSION[$key] ?? null;
    }
}
