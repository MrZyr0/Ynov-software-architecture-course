<?php


namespace App\Entities;

use App\Interfaces\IDisplayable;

class Book extends AbstractProduct implements IDisplayable
{
    private int $nbPages;


    /**
     * Get the value of nbPages
     *
     * @return int number of pages
     */
    public function getNbPages(): int
    {
        return $this->nbPages;
    }

    /**
     * Set the value of nbPages
     *
     * @param $nbPages
     * @return int number of pages
     */
    public function setNbPages($nbPages): int
    {
        $this->nbPages = $nbPages;

        return $this->nbPages;
    }

    /**
     * Echo object into string
     */
    public function display(): void
    {
        echo "Je suis un livre de " . $this->nbPages . " pages";
    }

    /**
     * Get full price of this book
     *
     * @return float
     */
    public function getFullPrice(): float
    {
        return $this->price * 1.2;
    }
}