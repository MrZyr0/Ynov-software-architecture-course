<?php


namespace App\Entities;


abstract class AbstractProduct
{
    use NameTrait;

    protected float $price;


    /**
     * AbstractProduct constructor.
     *
     * @param string $name
     * @param float $price
     */
    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * Get Product price
     *
     * @return float price
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Set Product price
     *
     * @param float $price
     * @return float price
     */
    public function setPrice(float $price): float
    {
        $this->price = $price;

        return $this->price;
    }

    /**
     * Get full price of this product
     *
     * @return float full price
     */
    abstract protected function getFullPrice(): float;
}
