<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ServiceSongRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceSongRepository::class)]
class ServiceSong
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'integer')]
    private int $sequence;

    #[ORM\ManyToOne(targetEntity: Song::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Song $song;

    #[ORM\ManyToOne(targetEntity: Liturgy::class)]
    private ?Liturgy $liturgy;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSequence(): ?int
    {
        return $this->sequence;
    }

    public function setSequence(int $sequence): self
    {
        $this->sequence = $sequence;

        return $this;
    }

    public function getSong(): ?Song
    {
        return $this->song;
    }

    public function setSong(Song $song): self
    {
        $this->song = $song;

        return $this;
    }

    public function getLiturgy(): ?Liturgy
    {
        return $this->liturgy;
    }

    public function setLiturgy(?Liturgy $liturgy): self
    {
        $this->liturgy = $liturgy;

        return $this;
    }
}
