<?php

namespace App\Tests\Entity;

use App\Entity\Affectation;
use App\Entity\Chantier;
use App\Entity\Employe;
use PHPUnit\Framework\TestCase;

class AffectationTest extends TestCase
{
    public function testAffectationCreation()
    {
        $affectation = new Affectation();

        // Vérification des valeurs initiales
        $this->assertNull($affectation->getId());
        $this->assertNull($affectation->getChantier());
        $this->assertNull($affectation->getEmploye());
        $this->assertNull($affectation->getDateAffectationDebut());
        $this->assertNull($affectation->getDateAffectationFin());
    }

    public function testSetAndGetChantier()
    {
        $affectation = new Affectation();
        $chantier = new Chantier();
        $chantier->setNom("Chantier Test");

        $affectation->setChantier($chantier);

        $this->assertSame($chantier, $affectation->getChantier());
        $this->assertSame("Chantier Test", $affectation->getChantier()->getNom());
    }

    public function testSetAndGetEmploye()
    {
        $affectation = new Affectation();
        $employe = new Employe();
        $employe->setNom("Doe")->setPrenom("John");

        $affectation->setEmploye($employe);

        $this->assertSame($employe, $affectation->getEmploye());
        $this->assertSame("Doe", $affectation->getEmploye()->getNom());
        $this->assertSame("John", $affectation->getEmploye()->getPrenom());
    }

    public function testSetAndGetDateAffectationDebut()
    {
        $affectation = new Affectation();
        $dateDebut = new \DateTime('2025-01-01');

        $affectation->setDateAffectationDebut($dateDebut);

        $this->assertSame($dateDebut, $affectation->getDateAffectationDebut());
    }

    public function testSetAndGetDateAffectationFin()
    {
        $affectation = new Affectation();
        $dateFin = new \DateTime('2025-06-01');

        $affectation->setDateAffectationFin($dateFin);

        $this->assertSame($dateFin, $affectation->getDateAffectationFin());
    }
}
