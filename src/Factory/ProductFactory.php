<?php


namespace App\Factory;


use App\Entities\AbstractProduct;
use App\Entities\Book;
use App\Entities\Clothing;
use App\Types\ProductType;
use Cassandra\Exception\InvalidArgumentException;

class ProductFactory
{
    private static int $productIndex = 0;

    public static function create(int $type): AbstractProduct
    {
        switch ($type) {
            case ProductType::BOOK:
                $product = new Book(sprintf(' "#%s Book example product', ProductFactory::$productIndex), 10);
                break;
            case ProductType::CLOTHING:
                $product = new Clothing(sprintf(' "#%s Dress example product', ProductFactory::$productIndex), 15);
                break;
            default:
                throw new InvalidArgumentException('Type de produit inconnu', null, null);
        }

        ProductFactory::$productIndex++;

        return $product;
    }
}