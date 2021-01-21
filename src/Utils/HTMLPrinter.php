<?php


namespace App\Utils;


use Exception;

abstract class HTMLPrinter
{
    public static function dump($var)
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }

    public static function heading(string $text, int $level)
    {
        if ($level > 4) {
            throw new Exception("A heading couldn't higher than level 4");
        }

        $markup = 'h' . $level;

        echo sprintf('<%s>%s</%s>', $markup, $text, $markup);
    }
}
