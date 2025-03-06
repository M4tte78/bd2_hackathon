<?php

namespace App\Tests\Entity;

use App\Entity\Chantier;
use App\Entity\Statut;
use App\Entity\Affectation;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\Collection;

class ChantierTest extends TestCase
{
    public function testChantierCreation()
    {
        $chantier = new Chantier();

        // Vérification des valeurs initiales
        $this->assertNull($chantier->getId());
        $this->assertInstanceOf(Collection::class, $chantier->getAffectations());
        $this->assertCount(0, $chantier->getAffectations());
    }

    public function testSetAndGetNom()
    {
        $chantier = new Chantier();
        $chantier->setNom("Chantier Test");

        $this->assertSame("Chantier Test", $chantier->getNom());
    }

    public function testSetAndGetAdresse()
    {
        $chantier = new Chantier();
        $chantier->setAdresse("123 Rue de Paris");

        $this->assertSame("123 Rue de Paris", $chantier->getAdresse());
    }

    public function testSetAndGetDateDebut()
    {
        $chantier = new Chantier();
        $dateDebut = new \DateTime('2025-01-01');

        $chantier->setDateDebut($dateDebut);

        $this->assertSame($dateDebut, $chantier->getDateDebut());
    }

    public function testSetAndGetDateFin()
    {
        $chantier = new Chantier();
        $dateFin = new \DateTime('2025-06-01');

        $chantier->setDateFin($dateFin);

        $this->assertSame($dateFin, $chantier->getDateFin());
    }

    public function testSetAndGetStatut()
    {
        $chantier = new Chantier();
        $statut = new Statut();
        $statut->setStatut("En cours");

        $chantier->setStatut($statut);

        $this->assertSame($statut, $chantier->getStatut());
        $this->assertSame("En cours", $chantier->getStatut()->getStatut());
    }

    public function testAddAndRemoveAffectation()
    {
        $chantier = new Chantier();
        $affectation = new Affectation();

        $chantier->addAffectation($affectation);

        $this->assertCount(1, $chantier->getAffectations());
        $this->assertTrue($chantier->getAffectations()->contains($affectation));

        $chantier->removeAffectation($affectation);

        $this->assertCount(0, $chantier->getAffectations());
        $this->assertFalse($chantier->getAffectations()->contains($affectation));
    }

    public function testToString()
    {
        $chantier = new Chantier();
        $chantier->setNom("Chantier A");
        $chantier->setAdresse("456 Avenue des Champs");

        $this->assertSame("Chantier A - 456 Avenue des Champs", (string) $chantier);
    }
}
