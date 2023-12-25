<?php

namespace App\Helpers;

class FormHelper
{
    public static function isFormSubmitted()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public static function getFieldValue($fieldName)
    {
        return $_POST[$fieldName] ?? '';
    }

    public static function isFieldEmpty($fieldName)
    {
        return empty($_POST[$fieldName]);
    }

    public static function validateField($fieldName, $rules = [])
    {
        foreach ($rules as $rule => $value) {
            switch ($rule) {
                case 'required':
                    if (self::isFieldEmpty($fieldName)) {
                        return false;
                    }
                    break;

                case 'min_length':
                    if (strlen(self::getFieldValue($fieldName)) < $value) {
                        return false;
                    }
                    break;

                case 'in_array':
                    if (!in_array(self::getFieldValue($fieldName), $value)) {
                        return false;
                    };
                    break;

                default:
                    // Gérer d'autres règles si nécessaire
                    break;
            }
        }

        return true;
    }

    public static function escapeValue($value)
    {
        // Utilisez la méthode d'échappement appropriée (ex: htmlspecialchars)
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}
