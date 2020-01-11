<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VehiculeRepository")
 */
class Vehicule
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $energie;

    /**
     * @ORM\Column(type="string", length=125, nullable=true)
     */
    private $kilometrage;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $annee;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $modele;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commune", inversedBy="vehicules")
     */
    private $commune;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="vehicule")
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reserver", mappedBy="vehicule")
     */
    private $reservers;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $metas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="vehicules")
     */
    private $proprietaire;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->reservers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(?string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getEnergie(): ?string
    {
        return $this->energie;
    }

    public function setEnergie(string $energie): self
    {
        $this->energie = $energie;

        return $this;
    }

    public function getKilometrage(): ?string
    {
        return $this->kilometrage;
    }

    public function setKilometrage(?string $kilometrage): self
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->annee;
    }

    public function setAnnee(?\DateTimeInterface $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(?string $modele): self
    {
        $this->modele = $modele;

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

    public function getCommune(): ?Commune
    {
        return $this->commune;
    }

    public function setCommune(?Commune $commune): self
    {
        $this->commune = $commune;

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
            $image->setVehicule($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getVehicule() === $this) {
                $image->setVehicule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reserver[]
     */
    public function getReservers(): Collection
    {
        return $this->reservers;
    }

    public function addReserver(Reserver $reserver): self
    {
        if (!$this->reservers->contains($reserver)) {
            $this->reservers[] = $reserver;
            $reserver->setVehicule($this);
        }

        return $this;
    }

    public function removeReserver(Reserver $reserver): self
    {
        if ($this->reservers->contains($reserver)) {
            $this->reservers->removeElement($reserver);
            // set the owning side to null (unless already changed)
            if ($reserver->getVehicule() === $this) {
                $reserver->setVehicule(null);
            }
        }

        return $this;
    }

    public function getMetas(): ?string
    {
        return $this->metas;
    }

    public function setMetas(?string $metas): self
    {
        $this->metas = $metas;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getProprietaire(): ?User
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?User $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }
}
