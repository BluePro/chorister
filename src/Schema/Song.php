<?php

declare(strict_types=1);

namespace App\Schema;

class Song
{
    private int $id;
    private string $name;
    /** @var Liturgy[] */
    private array $liturgy;
    /** @var Tag[] */
    private array $tags;
    /** @var SongBookHeader[] */
    private array $songBooks;

    /**
     * @param int $id
     * @param string $name
     * @param Liturgy[] $liturgy
     * @param Tag[] $tags
     * @param SongBookHeader[] $songBooks
     */
    public function __construct(int $id, string $name, array $liturgy, array $tags, array $songBooks)
    {
        $this->id = $id;
        $this->name = $name;
        $this->liturgy = $liturgy;
        $this->tags = $tags;
        $this->songBooks = $songBooks;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Liturgy[]
     */
    public function getLiturgy(): array
    {
        return $this->liturgy;
    }

    /**
     * @return Tag[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @return SongBookHeader[]
     */
    public function getSongBooks(): array
    {
        return $this->songBooks;
    }
}
