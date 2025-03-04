<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Chantier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private string $nom;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private string $adresse;

    #[ORM\Column(type: 'date')]
    #[Assert\NotNull]
    private \DateTimeInterface $date_debut;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\ManyToOne(targetEntity: Statut::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Statut $statut;

    #[ORM\OneToMany(mappedBy: 'chantier', targetEntity: Affectation::class, cascade: ['persist', 'remove'])]
    private Collection $affectations;

    public function __construct()
    {
        $this->affectations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;
        return $this;
    }

    public function getDateDebut(): \DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;
        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(?\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;
        return $this;
    }

    public function getStatut(): Statut
    {
        return $this->statut;
    }

    public function setStatut(Statut $statut): self
    {
        $this->statut = $statut;
        return $this;
    }

    /**
     * @return Collection<int, Affectation>
     */
    public function getAffectations(): Collection
    {
        return $this->affectations;
    }

    public function addAffectation(Affectation $affectation): self
    {
        if (!$this->affectations->contains($affectation)) {
            $this->affectations->add($affectation);
            $affectation->setChantier($this);
        }
        return $this;
    }

    public function removeAffectation(Affectation $affectation): self
    {
        if ($this->affectations->removeElement($affectation)) {
            if ($affectation->getChantier() === $this) {
                $affectation->setChantier(null);
            }
        }
        return $this;
    }

    public function __toString(): string
    {
        return $this->nom . ' - ' . $this->adresse; 
    }
}
