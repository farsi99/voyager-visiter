<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Date(message= "la date d'arrivée doit être au bon format")
     * @Assert\GreaterThan("today",message="la date d'arrivée doit être supérrier à celle d'aujourd'hui")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Date(message= "la date de départ doit être au bon format")
     * @Assert\GreaterThan(propertyPath="dateDebut", message="La date fin doit être supérieur à la date de début")
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
     * Permet de savoir si les dates sont possible
     */
    public function isBookableDates()
    {
        // 1 - il faut connaitre les dates impossible pour l'annonce
        $notAvailabledays = $this->biens->getNotAvialableDays();

        //2 - Compparer les dates impossible avec la date possible
        $bookingDays = $this->getDays();

        $formtDays = function ($day) {
            return $day->format('Y-m-d');
        };

        $days = array_map($formtDays, $bookingDays);

        $notAvalable = array_map($formtDays, $notAvailabledays);

        foreach ($days as $day) {
            if (array_search($day, $notAvalable) !== false) return false;
        }
        return true;
    }

    /**
     * Permet de recuperer un tableau des journées reservers
     * @return array un tableau des jours choisi par le client
     */
    public function getDays()
    {
        $resultat = range(
            $this->dateDebut->getTimestamp(),
            $this->dateFin->getTimestamp(),
            24 * 60 * 60
        );

        $days = array_map(function ($daysTimestamp) {
            return new \DateTime(date('Y-m-d', $daysTimestamp));
        }, $resultat);

        return $days;
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
