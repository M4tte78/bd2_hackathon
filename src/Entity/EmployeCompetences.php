<?php

namespace App\Entity;

use App\Repository\EmployeCompetencesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeCompetencesRepository::class)]
class EmployeCompetences
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
