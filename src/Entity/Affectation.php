<?php

namespace App\Entity;

use App\Repository\AffectationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AffectationRepository::class)]
class Affectation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Chantier::class, inversedBy: 'affectations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chantier $chantier = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_affectation_debut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_affectation_fin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChantier(): ?Chantier
    {
        return $this->chantier;
    }

    public function setChantier(?Chantier $chantier): self
    {
        $this->chantier = $chantier;

        return $this;
    }

    public function getDateAffectationDebut(): ?\DateTimeInterface
    {
        return $this->date_affectation_debut;
    }

    public function setDateAffectationDebut(\DateTimeInterface $date_affectation_debut): static
    {
        $this->date_affectation_debut = $date_affectation_debut;

        return $this;
    }

    public function getDateAffectationFin(): ?\DateTimeInterface
    {
        return $this->date_affectation_fin;
    }

    public function setDateAffectationFin(\DateTimeInterface $date_affectation_fin): static
    {
        $this->date_affectation_fin = $date_affectation_fin;

        return $this;
    }
}
