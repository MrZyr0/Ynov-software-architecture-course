<?php


namespace App\Helpers;


use App\Factory\ProductFactory;
use App\Managers\PostManager;
use App\Types\ProductType;
use App\Utils\HTMLPrinter;
use Exception;
use InvalidArgumentException;

abstract class DemoHelper
{
    const DEMO_SINGLETON = 1;
    const DEMO_FACTORY_BASIC = 2;
    const DEMO_FACTORY_ADVANCED = 3;

    public static function demoPrinter()
    {
        HTMLPrinter::demoForm();


        if (!empty($_POST) && !empty($_POST['demo'])) {
            switch ($_POST['demo']) {
                case self::DEMO_SINGLETON:
                    self::singletonUsage();
                    break;

                case self::DEMO_FACTORY_BASIC:
                    self::basicFactoryUsage();
                    break;

                case self::DEMO_FACTORY_ADVANCED:
                    self::advancedFactoryUsage();
                    break;

                default:
                    echo sprintf('<p>%s</p>', 'unknown demo number');
                    break;
            }
        }
    }

    public static function singletonUsage()
    {
        PostManager::init();

        for ($index = 0; $index < 10; $index++) {
            PostManager::insertOneExamplePost();
        }
        $posts = PostManager::getAllPosts();


        $post_0 = PostManager::getPostById("1");


        HTMLPrinter::heading('Example of singleton usage', 2);

        HTMLPrinter::dump($posts);

        HTMLPrinter::dump($post_0);
    }

    public static function basicFactoryUsage()
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

        HTMLPrinter::heading('Example of factory basic usage', 2);

        HTMLPrinter::dump($products);
    }

    public static function advancedFactoryUsage()
    {
        HTMLPrinter::heading('Example of factory advanced usage', 2);

        if (!empty($_POST) && !empty($_POST['productType'])) {
            $productFactory = new ProductFactory();

            try {
                $product = $productFactory->create(intval($_POST['productType']));
            } catch (InvalidArgumentException $e) {
                die('Une erreur est survenue : ' . $e->getMessage());
            }

            HTMLPrinter::flash('Here is the product you are asking to create :');
            HTMLPrinter::dump($product);
        }

        HTMLPrinter::productForm();
    }
}
