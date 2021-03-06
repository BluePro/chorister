<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\SongRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SongRepository::class)]
class Song
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'song', targetEntity: Catalog::class, orphanRemoval: true)]
    private Collection $catalogs;

    #[ORM\ManyToMany(targetEntity: Liturgy::class, inversedBy: 'songs')]
    private Collection $liturgy;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'songs')]
    private Collection $tags;

    #[ORM\ManyToOne(targetEntity: Period::class, inversedBy: 'songs')]
    private ?Period $period;

    public function __construct()
    {
        $this->catalogs = new ArrayCollection();
        $this->liturgy = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

  /**
   * @return Collection|Catalog[]
   */
    public function getCatalogs(): Collection
    {
        return $this->catalogs;
    }

    public function addCatalog(Catalog $catalog): self
    {
        if (!$this->catalogs->contains($catalog)) {
            $this->catalogs[] = $catalog;
            $catalog->setSong($this);
        }

        return $this;
    }

    public function removeCatalog(Catalog $catalog): self
    {
        $this->catalogs->removeElement($catalog);

        return $this;
    }

    /**
     * @return Collection|Liturgy[]
     */
    public function getLiturgy(): Collection
    {
        return $this->liturgy;
    }

    public function addLiturgy(Liturgy $liturgy): self
    {
        if (!$this->liturgy->contains($liturgy)) {
            $this->liturgy[] = $liturgy;
        }

        return $this;
    }

    public function removeLiturgy(Liturgy $liturgy): self
    {
        $this->liturgy->removeElement($liturgy);

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    public function getPeriod(): ?Period
    {
        return $this->period;
    }

    public function setPeriod(?Period $period): self
    {
        $this->period = $period;

        return $this;
    }
}
