<?php


namespace App\Helpers;


class ValidateHelpers
{
    public static function required($fieldsRequired, $data)
    {
        foreach ($fieldsRequired as $field) {
            if (!isset($data[$field])) {
                return $field;
            }
        }

        return false;
    }
}
