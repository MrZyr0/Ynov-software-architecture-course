<?php


namespace App\Entities;


class Clothing extends AbstractProduct
{
    private string $size;


    public function __construct(string $name, float $price)
    {
        parent::__construct($name, $price);
        $this->name .= " - Vêtement";
    }

    /**
     * Get the value of size
     *
     * @return string clothing size
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * Set the value of size
     *
     * @param $size
     * @return string
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this->size;
    }

    /**
     * Get full price of this clothing
     *
     * @return float full price
     */
    public function getFullPrice(): float
    {
        return $this->price * 1.05;
    }
}