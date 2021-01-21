<?php


namespace App\Utils;


use App\Types\ProductType;
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

    public static function flash(string $text)
    {
        echo sprintf('<p style="border: 1px solid; padding: 0.5rem 1rem;" ">%s</p>', $text);
    }

    public static function productForm()
    {
        echo sprintf('
            <form method="post">
                <select name="productType">
                    <option value="%s">Livre</option>
                    <option value="%s">Vêtement</option>
                </select>
                <input type="submit" value="Créer" />
            </form>',
            ProductType::BOOK,
            ProductType::CLOTHING
        );
    }
}
