<?php

declare(strict_types=1);

namespace App\Schema;

class Catalog
{
    private string $name;
    private string $number;

    public function __construct(string $name, string $number)
    {
        $this->name = $name;
        $this->number = $number;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNumber(): string
    {
        return $this->number;
    }
}
