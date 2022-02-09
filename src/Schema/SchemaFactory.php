<?php

declare(strict_types=1);

namespace App\Schema;

use App\Entity;

class SchemaFactory
{
    public function createSongBook(Entity\SongBook $songBookEntity): SongBook
    {
        $catalogList = [];
        foreach ($songBookEntity->getCatalogs() as $catalogEntity) {
            $catalogList[] = $this->createCatalog($catalogEntity);
        }

        return new SongBook(
            $songBookEntity->getId(),
            $songBookEntity->getName(),
            $songBookEntity->getColor(),
            $catalogList
        );
    }

    private function createCatalog(Entity\Catalog $catalogEntity): Catalog
    {
        return new Catalog(
            $catalogEntity->getSong()->getName(),
            $catalogEntity->getNumber()
        );
    }

    /**
     * @param Entity\SongBook[] $entityList
     * @return SongBookHeader[]
     */
    public function createSongBookList(array $entityList): array
    {
        $list = [];
        foreach ($entityList as $songBookEntity) {
            $list[] = $this->createSongBookHeader($songBookEntity);
        }

        return $list;
    }

    public function createSongBookHeader(Entity\SongBook $songBookEntity): SongBookHeader
    {
        return new SongBookHeader(
            $songBookEntity->getId(),
            $songBookEntity->getName(),
            $songBookEntity->getColor()
        );
    }
}
