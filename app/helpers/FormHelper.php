<?php

namespace App\Helpers;

class FormHelper
{
    public static function isFormSubmitted()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public static function getValue($fieldName)
    {
        return $_POST[$fieldName] ?? '';
    }

    public static function isEmpty($fieldName)
    {
        return empty($_POST[$fieldName]);
    }

    public static function validate($fieldName, $rules = [])
    {
        foreach ($rules as $rule => $value) {
            switch ($rule) {
                case 'required':
                    if (self::isEmpty($fieldName)) {
                        return false;
                    }
                    break;

                case 'max_length':
                    if (strlen(self::getValue($fieldName)) > $value) {
                        return false;
                    }
                    break;

                case 'in_array':
                    if (!in_array(self::getValue($fieldName), $value)) {
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

    public static function validates($fields)
    {
        foreach ($fields as $fieldName => $rules) {
            if (!self::validate($fieldName, $rules)) {
                return false;
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
