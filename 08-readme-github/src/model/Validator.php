<?php

namespace Vidamrr\Readme\model;

class Validator
{

    public static function get($arr, $index)
    {
        if (isset($arr[$index])) {
            return $arr[$index];
        } else {
            return null;
        }
    }

    public static function getArray($arr, $index)
    {
        if (isset($arr[$index]) && is_array($arr[$index])) {
            return $arr[$index];
        } else {
            return null;
        }
    }

    public static function getValue($obj, $prop)
    {
        if (isset($obj)) {
            return $obj->{$prop}();
        } else {
            return '';
        }
    }
}
