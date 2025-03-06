<?php

namespace App\Tests\Entity;

use App\Entity\Employe;
use PHPUnit\Framework\TestCase;

class EmployeTest extends TestCase
{
    public function testEmployeCreation()
    {
        $employe = new Employe();
        $employe->setNom('Dupont');
        $employe->setPrenom('Jean');
        $employe->setEmail('jean.dupont@example.com');
        $employe->setTelephone('0123456789');
        $employe->setAdresse('10 rue de Paris');

        $this->assertEquals('Dupont', $employe->getNom());
        $this->assertEquals('Jean', $employe->getPrenom());
        $this->assertEquals('jean.dupont@example.com', $employe->getEmail());
        $this->assertEquals('0123456789', $employe->getTelephone());
        $this->assertEquals('10 rue de Paris', $employe->getAdresse());
    }
}
