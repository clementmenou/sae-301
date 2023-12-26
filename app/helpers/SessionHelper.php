<?php

namespace App\Helpers;

class SessionHelper
{
    public static function setValue($key, $subKey, $value, $isSet = false)
    {
        self::start();

        if (self::isActive()) {
            if (!$isSet) {
                if ($subKey !== null) {
                    // Set sub variable
                    $_SESSION[$key][$subKey] = $value;
                } else {
                    // Set main variable
                    $_SESSION[$key] = $value;
                }
            } else {
                if ($subKey !== null) {
                    // Set sub variable
                    $_SESSION[$key][$subKey] ??= $value;
                } else {
                    // Set main variable
                    $_SESSION[$key] ??= $value;
                }
            }
        }
    }

    public static function getValue($key, $subKey = null, $default = null)
    {
        self::start();

        if (self::isActive()) {
            if ($subKey !== null) {
                return $_SESSION[$key][$subKey] ?? $default;
            } else {
                return $_SESSION[$key] ?? $default;
            }
        }

        return $default;
    }

    public static function unsetValue($key, $subKey = null)
    {
        self::start();

        if (self::isActive()) {
            if ($subKey !== null) {
                // Suppr sub variable
                if (isset($_SESSION[$key][$subKey])) {
                    unset($_SESSION[$key][$subKey]);
                }
            } else {
                // Suppr main variable
                if (isset($_SESSION[$key])) {
                    unset($_SESSION[$key]);
                }
            }
        }
    }

    public static function valueExists($key, $subKey = null)
    {
        self::start();

        if (self::isActive()) {
            if ($subKey !== null) {
                return isset($_SESSION[$key][$subKey]);
            } else {
                return isset($_SESSION[$key]);
            }
        }

        return false;
    }

    private static function isActive()
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }

    private static function start()
    {
        if (!self::isActive()) {
            session_set_cookie_params([
                // 'secure' => true,    // HTTPS only
                'httponly' => true    // Cookie not accesible with JavaScript
            ]);

            // Start
            session_start();
        }
    }
}
