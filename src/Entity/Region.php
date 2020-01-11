<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegionRepository")
 */
class Region
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomRegion;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="region")
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Biens", mappedBy="region")
     */
    private $biens;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->biens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRegion(): ?string
    {
        return $this->nomRegion;
    }

    public function setNomRegion(string $nomRegion): self
    {
        $this->nomRegion = $nomRegion;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setRegion($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getRegion() === $this) {
                $image->setRegion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Biens[]
     */
    public function getBiens(): Collection
    {
        return $this->biens;
    }

    public function addBien(Biens $bien): self
    {
        if (!$this->biens->contains($bien)) {
            $this->biens[] = $bien;
            $bien->setRegion($this);
        }

        return $this;
    }

    public function removeBien(Biens $bien): self
    {
        if ($this->biens->contains($bien)) {
            $this->biens->removeElement($bien);
            // set the owning side to null (unless already changed)
            if ($bien->getRegion() === $this) {
                $bien->setRegion(null);
            }
        }

        return $this;
    }
}
