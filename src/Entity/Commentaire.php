<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireRepository")
 */
class Commentaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $vote;

    /**
     * @ORM\Column(type="text")
     */
    private $contenue;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Actualite", inversedBy="commentaires")
     */
    private $actualite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Reserver", inversedBy="commentaires")
     */
    private $reserver;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="commentaires")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVote(): ?float
    {
        return $this->vote;
    }

    public function setVote(?float $vote): self
    {
        $this->vote = $vote;

        return $this;
    }

    public function getContenue(): ?string
    {
        return $this->contenue;
    }

    public function setContenue(string $contenue): self
    {
        $this->contenue = $contenue;

        return $this;
    }



    public function getActualite(): ?Actualite
    {
        return $this->actualite;
    }

    public function setActualite(?Actualite $actualite): self
    {
        $this->actualite = $actualite;

        return $this;
    }

    public function getReserver(): ?Reserver
    {
        return $this->reserver;
    }

    public function setReserver(?Reserver $reserver): self
    {
        $this->reserver = $reserver;

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
}
