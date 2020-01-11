<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BiensRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Biens
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
     * @ORM\Column(type="float", nullable=true)
     */
    private $superficie;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrePiece;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbreChambre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $salleBain;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pays;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeBien;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commune", inversedBy="biens")
     */
    private $commune;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="biens")
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reserver", mappedBy="biens")
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Region", inversedBy="biens")
     */
    private $region;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="biens")
     */
    private $proprio;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbreVisiteur;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $internet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cuisine;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $electricite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $eau;

    /**
     * @ORM\Column(type="boolean")
     */
    private $climatisation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbreLit;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $parking;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $longitude;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Favoris", mappedBy="bien")
     */
    private $favoris;


    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->reservers = new ArrayCollection();
        $this->favoris = new ArrayCollection();
    }


    /**
     * Permet d'initialier le slug avant de persister
     * 
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return void
     */
    public function initializeSlug()
    {
        if (empty($this->slug)) {
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->titre);
        }
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

    public function getSuperficie(): ?float
    {
        return $this->superficie;
    }

    public function setSuperficie(?float $superficie): self
    {
        $this->superficie = $superficie;

        return $this;
    }

    public function getNbrePiece(): ?int
    {
        return $this->nbrePiece;
    }

    public function setNbrePiece(int $nbrePiece): self
    {
        $this->nbrePiece = $nbrePiece;

        return $this;
    }

    public function getNbreChambre(): ?int
    {
        return $this->nbreChambre;
    }

    public function setNbreChambre(?int $nbreChambre): self
    {
        $this->nbreChambre = $nbreChambre;

        return $this;
    }

    public function getSalleBain(): ?int
    {
        return $this->salleBain;
    }

    public function setSalleBain(?int $salleBain): self
    {
        $this->salleBain = $salleBain;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(?string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;

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

    public function getTypeBien(): ?string
    {
        return $this->typeBien;
    }

    public function setTypeBien(?string $typeBien): self
    {
        $this->typeBien = $typeBien;

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
            $image->setBiens($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getBiens() === $this) {
                $image->setBiens(null);
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
            $reserver->setBiens($this);
        }

        return $this;
    }

    public function removeReserver(Reserver $reserver): self
    {
        if ($this->reservers->contains($reserver)) {
            $this->reservers->removeElement($reserver);
            // set the owning side to null (unless already changed)
            if ($reserver->getBiens() === $this) {
                $reserver->setBiens(null);
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

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

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

    public function getProprio(): ?User
    {
        return $this->proprio;
    }

    public function setProprio(?User $proprio): self
    {
        $this->proprio = $proprio;

        return $this;
    }

    public function getNbreVisiteur(): ?int
    {
        return $this->nbreVisiteur;
    }

    public function setNbreVisiteur(?int $nbreVisiteur): self
    {
        $this->nbreVisiteur = $nbreVisiteur;

        return $this;
    }

    public function getInternet(): ?bool
    {
        return $this->internet;
    }

    public function setInternet(?bool $internet): self
    {
        $this->internet = $internet;

        return $this;
    }

    public function getCuisine(): ?string
    {
        return $this->cuisine;
    }

    public function setCuisine(?string $cuisine): self
    {
        $this->cuisine = $cuisine;

        return $this;
    }

    public function getElectricite(): ?string
    {
        return $this->electricite;
    }

    public function setElectricite(?string $electricite): self
    {
        $this->electricite = $electricite;

        return $this;
    }

    public function getEau(): ?string
    {
        return $this->eau;
    }

    public function setEau(?string $eau): self
    {
        $this->eau = $eau;

        return $this;
    }

    public function getClimatisation(): ?bool
    {
        return $this->climatisation;
    }

    public function setClimatisation(bool $climatisation): self
    {
        $this->climatisation = $climatisation;

        return $this;
    }

    public function getNbreLit(): ?int
    {
        return $this->nbreLit;
    }

    public function setNbreLit(?int $nbreLit): self
    {
        $this->nbreLit = $nbreLit;

        return $this;
    }

    public function getParking(): ?string
    {
        return $this->parking;
    }

    public function setParking(?string $parking): self
    {
        $this->parking = $parking;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection|Favoris[]
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Favoris $favori): self
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris[] = $favori;
            $favori->setBien($this);
        }

        return $this;
    }

    public function removeFavori(Favoris $favori): self
    {
        if ($this->favoris->contains($favori)) {
            $this->favoris->removeElement($favori);
            // set the owning side to null (unless already changed)
            if ($favori->getBien() === $this) {
                $favori->setBien(null);
            }
        }

        return $this;
    }
}
