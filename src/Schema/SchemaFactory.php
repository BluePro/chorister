<?php

declare(strict_types=1);

namespace App\Schema;

use App\Entity;
use Throwable;

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

    private function createSongBookHeader(Entity\SongBook $songBookEntity): SongBookHeader
    {
        return new SongBookHeader(
            $songBookEntity->getId(),
            $songBookEntity->getName(),
            $songBookEntity->getColor()
        );
    }

    public function createSong(Entity\Song $songEntity): Song
    {
        $liturgyList = [];
        foreach ($songEntity->getLiturgy() as $liturgyEntity) {
            $liturgyList[] = $this->createLiturgy($liturgyEntity);
        }

        $tagList = [];
        foreach ($songEntity->getTags() as $tagEntity) {
            $tagList[] = $this->createTag($tagEntity);
        }

        $songBookList = [];
        foreach ($songEntity->getCatalogs() as $catalogEntity) {
            $songBookList[] = $this->createSongBookHeader($catalogEntity->getSongbook());
        }
        $period = $songEntity->getPeriod() ? $this->createPeriod($songEntity->getPeriod()) : null;

        return new Song(
            $songEntity->getId(),
            $songEntity->getName(),
            $period,
            $liturgyList,
            $tagList,
            $songBookList
        );
    }

    private function createPeriod(Entity\Period $period): Period
    {
        return new Period(
            $period->getCode(),
            $period->getName()
        );
    }

    private function createLiturgy(Entity\Liturgy $liturgy): Liturgy
    {
        return new Liturgy(
            $liturgy->getCode(),
            $liturgy->getName()
        );
    }

    private function createTag(Entity\Tag $tagEntity): Tag
    {
        return new Tag(
            $tagEntity->getName()
        );
    }

    /**
     * @param Entity\Song[] $entityList
     * @return Song[]
     */
    public function createSongList(array $entityList): array
    {
        $list = [];
        foreach ($entityList as $songEntity) {
            $list[] = $this->createSong($songEntity);
        }

        return $list;
    }

    public function createError(Throwable $exception): Error
    {
        return new Error(
            $exception->getCode(),
            $exception->getMessage()
        );
    }
}
