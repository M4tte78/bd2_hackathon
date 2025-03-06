<?php

namespace App\Tests\Entity;

use App\Entity\Statut;
use PHPUnit\Framework\TestCase;

class StatutTest extends TestCase
{
    public function testStatutCreation()
    {
        $statut = new Statut();

        // Vérification des valeurs initiales
        $this->assertNull($statut->getId());
        $this->assertNull($statut->getStatut());
    }

    public function testSetAndGetStatut()
    {
        $statut = new Statut();
        $statutValue = "En cours";

        $statut->setStatut($statutValue);

        $this->assertSame($statutValue, $statut->getStatut());
    }

    public function testToString()
    {
        $statut = new Statut();
        $statutValue = "Terminé";

        $statut->setStatut($statutValue);

        $this->assertSame($statutValue, (string) $statut);
    }
}
