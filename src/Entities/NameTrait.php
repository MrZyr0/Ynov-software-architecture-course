<?php


namespace App\Entities;


trait NameTrait
{
    /**
     * Name property
     *
     * @var string name
     */
    protected string $name;


    /**
     * Get the value of name
     *
     * @return string name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     * @return string name
     */
    public function setName(string $name): string
    {
        $this->name = $name;

        return $this;
    }
}