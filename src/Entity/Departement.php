<?php

namespace App\Entity;

use App\Repository\DepartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepartementRepository::class)
 */
class Departement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nom_depart;

    /**
     * @ORM\OneToMany(targetEntity=Professeur::class, mappedBy="departement")
     */
    private $professeur;

    public function __construct()
    {
        $this->professeur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDepart(): ?string
    {
        return $this->nom_depart;
    }

    public function setNomDepart(string $nom_depart): self
    {
        $this->nom_depart = $nom_depart;

        return $this;
    }

    /**
     * @return Collection|Professeur[]
     */
    public function getProfesseur(): Collection
    {
        return $this->professeur;
    }

    public function addProfesseur(Professeur $professeur): self
    {
        if (!$this->professeur->contains($professeur)) {
            $this->professeur[] = $professeur;
            $professeur->setDepartement($this);
        }

        return $this;
    }

    public function removeProfesseur(Professeur $professeur): self
    {
        if ($this->professeur->contains($professeur)) {
            $this->professeur->removeElement($professeur);
            // set the owning side to null (unless already changed)
            if ($professeur->getDepartement() === $this) {
                $professeur->setDepartement(null);
            }
        }

        return $this;
    }
}
