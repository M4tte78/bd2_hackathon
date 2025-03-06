<?php

namespace App\Tests\Entity;

use App\Entity\Competences;
use PHPUnit\Framework\TestCase;

class CompetencesTest extends TestCase
{
    public function testCompetencesCreation()
    {
        $competence = new Competences();

        // Vérification des valeurs initiales
        $this->assertNull($competence->getId());
        $this->assertNull($competence->getNom());
    }

    public function testSetAndGetNom()
    {
        $competence = new Competences();
        $nomValue = "PHP Development";

        $competence->setNom($nomValue);

        $this->assertSame($nomValue, $competence->getNom());
    }

    public function testToString()
    {
        $competence = new Competences();
        $nomValue = "JavaScript";

        $competence->setNom($nomValue);

        $this->assertSame($nomValue, (string) $competence);
    }
}
