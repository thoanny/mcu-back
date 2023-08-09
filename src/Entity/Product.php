<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $releasedAt = null;

    #[ORM\Column(length: 5)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $trailer = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $synopsis = null;

    #[ORM\Column]
    private ?bool $animation = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $duration = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $chronological = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $logical = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: VOD::class, orphanRemoval: true)]
    private Collection $VODs;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Episode::class, orphanRemoval: true)]
    private Collection $episodes;

    #[ORM\ManyToMany(targetEntity: Character::class)]
    private Collection $characters;

    public function __construct()
    {
        $this->VODs = new ArrayCollection();
        $this->episodes = new ArrayCollection();
        $this->characters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getReleasedAt(): ?\DateTimeImmutable
    {
        return $this->releasedAt;
    }

    public function setReleasedAt(?\DateTimeImmutable $releasedAt): static
    {
        $this->releasedAt = $releasedAt;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getTrailer(): ?string
    {
        return $this->trailer;
    }

    public function setTrailer(?string $trailer): static
    {
        $this->trailer = $trailer;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(?string $synopsis): static
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function isAnimation(): ?bool
    {
        return $this->animation;
    }

    public function setAnimation(bool $animation): static
    {
        $this->animation = $animation;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getChronological(): ?int
    {
        return $this->chronological;
    }

    public function setChronological(int $chronological): static
    {
        $this->chronological = $chronological;

        return $this;
    }

    public function getLogical(): ?int
    {
        return $this->logical;
    }

    public function setLogical(int $logical): static
    {
        $this->logical = $logical;

        return $this;
    }

    /**
     * @return Collection<int, VOD>
     */
    public function getVODs(): Collection
    {
        return $this->VODs;
    }

    public function addVOD(VOD $vOD): static
    {
        if (!$this->VODs->contains($vOD)) {
            $this->VODs->add($vOD);
            $vOD->setProduct($this);
        }

        return $this;
    }

    public function removeVOD(VOD $vOD): static
    {
        if ($this->VODs->removeElement($vOD)) {
            // set the owning side to null (unless already changed)
            if ($vOD->getProduct() === $this) {
                $vOD->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Episode>
     */
    public function getEpisodes(): Collection
    {
        return $this->episodes;
    }

    public function addEpisode(Episode $episode): static
    {
        if (!$this->episodes->contains($episode)) {
            $this->episodes->add($episode);
            $episode->setProduct($this);
        }

        return $this;
    }

    public function removeEpisode(Episode $episode): static
    {
        if ($this->episodes->removeElement($episode)) {
            // set the owning side to null (unless already changed)
            if ($episode->getProduct() === $this) {
                $episode->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Character>
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(Character $character): static
    {
        if (!$this->characters->contains($character)) {
            $this->characters->add($character);
        }

        return $this;
    }

    public function removeCharacter(Character $character): static
    {
        $this->characters->removeElement($character);

        return $this;
    }
}
