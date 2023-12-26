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
        return self::getValue($fieldName) == '';
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

                case 'min_length':
                    if (strlen(self::getValue($fieldName)) < $value) {
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

                case 'complexity':
                    $fieldValue = self::getValue($fieldName);
                    $complexity =
                        preg_match('/[A-Z]/', $fieldValue) &&
                        preg_match('/[a-z]/', $fieldValue) &&
                        preg_match('/[0-9]/', $fieldValue) &&
                        preg_match('/\W/', $fieldValue);
                    if (!$complexity) {
                        return false;
                    }
                    break;

                case 'match':
                    $fieldValue = self::getValue($fieldName);
                    $matchFieldValue = self::getValue($value);
                    if ($fieldValue !== $matchFieldValue) {
                        return false;
                    }
                    break;

                case 'not_used':
                    if ($value == 1) {
                        return false;
                    }
                    break;

                default:
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
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}
