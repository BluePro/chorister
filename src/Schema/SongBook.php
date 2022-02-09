<?php

declare(strict_types=1);

namespace App\Schema;

class SongBook
{
    private int $id;
    private string $name;
    private ?string $color;
    /** @var Catalog[] */
    private array $catalog;

    /**
     * @param int $id
     * @param string $name
     * @param ?string $color
     * @param Catalog[] $catalog
     */
    public function __construct(int $id, string $name, ?string $color, array $catalog)
    {
        $this->id = $id;
        $this->name = $name;
        $this->color = $color;
        $this->catalog = $catalog;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @return Catalog[]
     */
    public function getCatalog(): array
    {
        return $this->catalog;
    }
}
