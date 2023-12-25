<?php

namespace App\Helpers;

class SessionHelper
{
    public static function setSessionValue($key, $value, $subKey = null)
    {
        self::startSession();

        if (self::isSessionActive()) {
            if ($subKey !== null) {
                // Set sub variable
                if (!isset($_SESSION[$key])) {
                    $_SESSION[$key] = [];
                }

                $_SESSION[$key][$subKey] = $value;
            } else {
                // Set main variable
                $_SESSION[$key] = $value;
            }
        }
    }

    public static function getSessionValue($key, $subKey = null)
    {
        self::startSession();

        if (self::isSessionActive()) {
            if ($subKey !== null) {
                return $_SESSION[$key][$subKey] ?? null;
            } else {
                return $_SESSION[$key] ?? null;
            }
        }

        return null;
    }

    public static function unsetSessionValue($key, $subKey = null)
    {
        self::startSession();

        if (self::isSessionActive()) {
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

    public static function sessionValueExists($key, $subKey = null)
    {
        self::startSession();

        if (self::isSessionActive()) {
            if ($subKey !== null) {
                return isset($_SESSION[$key][$subKey]);
            } else {
                return isset($_SESSION[$key]);
            }
        }

        return false;
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
