<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date_Facture;

    /**
     * @ORM\Column(type="float")
     */
    private $Montant;

    

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="Facture")
     */
    private $client;

    /**
     * @ORM\OneToOne(targetEntity=Client::class, cascade={"persist", "remove"})
     */
    private $Client;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Payee;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateFacture(): ?\DateTimeInterface
    {
        return $this->Date_Facture;
    }

    public function setDateFacture(\DateTimeInterface $Date_Facture): self
    {
        $this->Date_Facture = $Date_Facture;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->Montant;
    }

    public function setMontant(float $Montant): self
    {
        $this->Montant = $Montant;

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

    public function getPayee(): ?bool
    {
        return $this->Payee;
    }

    public function setPayee(bool $Payee): self
    {
        $this->Payee = $Payee;

        return $this;
    }
}
