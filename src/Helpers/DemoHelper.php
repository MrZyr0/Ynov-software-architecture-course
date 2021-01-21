<?php


namespace App\Helpers;


use App\Factory\ProductFactory;
use App\Managers\PostManager;
use App\Types\ProductType;
use App\Utils\HTMLPrinter;
use Exception;

abstract class DemoHelper
{
    public static function singleton()
    {
        PostManager::init();

        for ($index = 0; $index < 10; $index++) {
            PostManager::insertOneExamplePost();
        }
        $posts = PostManager::getAllPosts();

        HTMLPrinter::dump($posts);


        $post_0 = PostManager::getPostById("1");

        HTMLPrinter::dump($post_0);
    }

    public static function factory()
    {
        $products = [];

        for ($index = 0; $index < 5; $index++) {
            try {
                if (1 === random_int(0, 5)) {
                    array_push($products, ProductFactory::create(ProductType::BOOK));
                } else {
                    array_push($products, ProductFactory::create(ProductType::CLOTHING));
                }
            } catch (Exception $e) {
                HTMLPrinter::dump($e);
            }
        }

        HTMLPrinter::dump($products);
    }
}
