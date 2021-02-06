<?php

namespace App\Entity;

use App\Repository\AgenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AgenceRepository::class)
 */
class Agence
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
    private $Nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $Num_Tel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Adress_Ville;

    /**
     * @ORM\OneToMany(targetEntity=Voiture::class, mappedBy="agence")
     */
    private $Voiture;

   
     
    public function __toString(){
        // to show the name of the Category in the select
        return $this->Nom;
        // to show the id of the Category in the select
        // return $this->id;
    }


    public function __construct()
    {
        $this->Voiture = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getNumTel(): ?int
    {
        return $this->Num_Tel;
    }

    public function setNumTel(int $Num_Tel): self
    {
        $this->Num_Tel = $Num_Tel;

        return $this;
    }

    public function getAdressVille(): ?string
    {
        return $this->Adress_Ville;
    }

    public function setAdressVille(string $Adress_Ville): self
    {
        $this->Adress_Ville = $Adress_Ville;

        return $this;
    }

    /**
     * @return Collection|Voiture[]
     */
    public function getVoiture(): Collection
    {
        return $this->Voiture;
    }

    public function addVoiture(Voiture $voiture): self
    {
        if (!$this->Voiture->contains($voiture)) {
            $this->Voiture[] = $voiture;
            $voiture->setAgence($this);
        }

        return $this;
    }

    public function removeVoiture(Voiture $voiture): self
    {
        if ($this->Voiture->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getAgence() === $this) {
                $voiture->setAgence(null);
            }
        }

        return $this;
    }
}
