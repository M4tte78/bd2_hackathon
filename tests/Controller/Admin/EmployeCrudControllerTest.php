<?php

namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Role;
use App\Entity\Employe;
use App\Entity\Competences;

class EmployeCrudControllerTest extends WebTestCase
{

    public function testCreateEmploye()
    {
        $client = static::createClient();
        $client->loginUser($this->getAdminUser());

        $employeRepository = self::getContainer()->get('doctrine')->getRepository(Employe::class);
        $existingEmploye = $employeRepository->findOneBy(['email' => 'tata.tata@tata.com']);
        $this->assertNull($existingEmploye);
        
        $competenceRepository = self::getContainer()->get('doctrine')->getRepository(Competences::class);
        $competence = $competenceRepository->findOneBy(['id' => 1]);

        $employe = new Employe();
        $employe->setNom('tata');
        $employe->setPrenom('tata');
        $employe->setEmail('tata.tata@tata.com');
        $employe->setTelephone('0123456789');
        $employe->setAdresse('1 rue de la République');
        $employe->addCompetence($competence);

        $entityManager = self::getContainer()->get('doctrine')->getManager();
        $entityManager->persist($employe);
        $entityManager->flush();

        $employe = $employeRepository->findOneBy(['email' => 'tata.tata@tata.com']);
        $this->assertNotNull($employe);
        $this->assertEquals('tata', $employe->getNom());
        $this->assertEquals('tata.tata@tata.com', $employe->getEmail());
    }


    private function getAdminUser()
    {
        $user = $this->getContainer()->get('doctrine')->getRepository(\App\Entity\Utilisateur::class)->findOneBy([
            'email' => 'admin@admin.com',
        ]);

        if (!$user) {
            throw new \Exception('Admin user not found');
        }

        return $user;
    }
}
