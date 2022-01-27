<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ServiceRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'datetime')]
    private DateTimeInterface $held;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeld(): ?DateTimeInterface
    {
        return $this->held;
    }

    public function setHeld(DateTimeInterface $held): self
    {
        $this->held = $held;

        return $this;
    }
}
