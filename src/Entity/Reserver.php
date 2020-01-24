<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReserverRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Reserver
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateFin;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $montant;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="reservers")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Biens", inversedBy="reservers")
     */
    private $biens;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire", mappedBy="reserver")
     */
    private $commentaires;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vehicule", inversedBy="reservers")
     */
    private $vehicule;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $infosuplementaire;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }

    /**
     * @ORM\prePersist
     */
    public function prePersist()
    {
        if (empty($this->dateCreation)) {
            $this->dateCreation = new \DateTime();
        }
        if (empty($this->montant)) {
            //on calcule nombre de jour x le montant
            $this->montant = $this->biens->getPrix() * $this->getDuration();
        }
    }


    /**
     * On crée une méthode qui nous permet de calculer la durée de la reservation
     */
    public function getDuration()
    {
        $diff = $this->dateFin->diff($this->dateDebut);
        return $diff->days;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(?float $montant): self
    {
        $this->montant = $montant;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getBiens(): ?Biens
    {
        return $this->biens;
    }

    public function setBiens(?Biens $biens): self
    {
        $this->biens = $biens;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setReserver($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getReserver() === $this) {
                $commentaire->setReserver(null);
            }
        }

        return $this;
    }

    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(?Vehicule $vehicule): self
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    public function getInfosuplementaire(): ?string
    {
        return $this->infosuplementaire;
    }

    public function setInfosuplementaire(?string $infosuplementaire): self
    {
        $this->infosuplementaire = $infosuplementaire;

        return $this;
    }
}
