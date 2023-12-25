<?php

namespace App\Helpers;

class SessionHelper
{
    public static function setSessionValue($key, $value)
    {
        self::startSession();

        if (self::isSessionActive()) {
            $_SESSION[$key] = $value;
        }
    }

    public static function getSessionValue($key)
    {
        self::startSession();

        return self::isSessionActive() ? ($_SESSION[$key] ?? null) : null;
    }

    private static function isSessionActive()
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }

    private static function startSession()
    {
        if (!self::isSessionActive()) {
            session_set_cookie_params([
                'secure' => true,    // HTTPS only
                'httponly' => true    // Cookie not accesible with JavaScript
            ]);

            // Start
            session_start();
        }
    }
}
