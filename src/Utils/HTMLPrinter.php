<?php


namespace App\Utils;


abstract class HTMLPrinter
{
    public static function dump($var)
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }
}
