<?php


namespace App\Utils;


use App\Helpers\DemoHelper;
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
                    <option value="%s">Book</option>
                    <option value="%s">Clothing</option>
                </select>
                <input type="submit" value="Create" />
                <input type="hidden" name="demo" value="%s">
            </form>',
            ProductType::BOOK,
            ProductType::CLOTHING,
            $_POST['demo']
        );
    }

    public static function demoForm()
    {
        echo sprintf('
            <p style="display: inline">Start a demo :</p>
            <form method="post" style="display: inline">
                <select name="demo">
                    <option value="%s">Singleton demo usage result</option>
                    <option value="%s">Factory demo basic usage result</option>
                    <option value="%s">Factory demo advanced usage result</option>
                </select>
                <input type="submit" value="Start" />
            </form>',
            DemoHelper::DEMO_SINGLETON,
            DemoHelper::DEMO_FACTORY_BASIC,
            DemoHelper::DEMO_FACTORY_ADVANCED,
        );
    }
}
