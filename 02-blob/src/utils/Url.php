<?php

namespace Vidamrr\Blog\utils;

class Url
{

    public static function getRootPath()
    {
        return substr(__DIR__, 0, strpos(__DIR__, 'src') + 3);
    }

    public static function require($relativePath)
    {
        //require URl::getRootPath() . $relativePath;
        require 'src/' . $relativePath;
    }
}
