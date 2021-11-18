<?php

namespace App;

class Helper
{
    public static function formatCode($code)
    {
        return str_replace('>', 'HTMLCloseTag', str_replace('<', 'HTMLOpenTag', $code));
    }

    public static function isJson($string) {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
