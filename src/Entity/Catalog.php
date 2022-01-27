<?php

namespace App\Entity;

use App\Repository\CatalogRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CatalogRepository::class)]
class Catalog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $number;

    #[ORM\ManyToOne(targetEntity: Song::class, inversedBy: 'catalogs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Song $song;

    #[ORM\ManyToOne(targetEntity: SongBook::class, inversedBy: 'catalogs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SongBook $songbook;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getSong(): ?Song
    {
        return $this->song;
    }

    public function setSong(?Song $song): self
    {
        $this->song = $song;

        return $this;
    }

    public function getSongbook(): ?SongBook
    {
        return $this->songbook;
    }

    public function setSongbook(?SongBook $songbook): self
    {
        $this->songbook = $songbook;

        return $this;
    }
}
