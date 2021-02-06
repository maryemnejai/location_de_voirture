<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContratRepository::class)
 */
class Contrat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date_Depart;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date_Retour;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="Contrat")
     * @ORM\JoinColumn(nullable=true)
     */
    private $client;

    /**
     * @ORM\OneToOne(targetEntity=Client::class, cascade={"persist", "remove"})
     */
    private $Client;

    /**
     * @ORM\ManyToOne(targetEntity=Voiture::class, inversedBy="contrats")
     * @ORM\JoinColumn(nullable=true)
     */
    private $voiture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->Date_Depart;
    }

    public function setDateDepart(\DateTimeInterface $Date_Depart): self
    {
        $this->Date_Depart = $Date_Depart;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->Date_Retour;
    }

    public function setDateRetour(\DateTimeInterface $Date_Retour): self
    {
        $this->Date_Retour = $Date_Retour;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getVoiture(): ?voiture
    {
        return $this->voiture;
    }

    public function setVoiture(?voiture $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
    }
}
