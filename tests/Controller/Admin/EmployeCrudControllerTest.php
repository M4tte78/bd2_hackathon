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
    public function testUpdateEmploye()
    {
        $client = static::createClient();
        $client->loginUser($this->getAdminUser());

        $employeRepository = self::getContainer()->get('doctrine')->getRepository(Employe::class);

        $employe = new Employe();
        $employe->setNom('initial');
        $employe->setPrenom('prenom');
        $employe->setEmail('update.test@example.com');
        $employe->setTelephone('0987654321');
        $employe->setAdresse('Adresse initiale');

        $competenceRepository = self::getContainer()->get('doctrine')->getRepository(Competences::class);
        $competence = $competenceRepository->findOneBy(['id' => 1]);
        $employe->addCompetence($competence);

        $entityManager = self::getContainer()->get('doctrine')->getManager();
        $entityManager->persist($employe);
        $entityManager->flush();

        $employeId = $employe->getId();

        $employe->setNom('updated');
        $employe->setPrenom('nouveau prenom');
        $employe->setEmail('updated.test@example.com');
        $employe->setTelephone('1234567890');
        $employe->setAdresse('Nouvelle adresse');

        $entityManager->persist($employe);
        $entityManager->flush();
        $entityManager->clear();

        $updatedEmploye = $employeRepository->find($employeId);
    
        $this->assertNotNull($updatedEmploye);
        $this->assertEquals('updated', $updatedEmploye->getNom());
        $this->assertEquals('nouveau prenom', $updatedEmploye->getPrenom());
        $this->assertEquals('updated.test@example.com', $updatedEmploye->getEmail());
        $this->assertEquals('1234567890', $updatedEmploye->getTelephone());
        $this->assertEquals('Nouvelle adresse', $updatedEmploye->getAdresse());
    }
    public function testDeleteEmploye()
    {
        $client = static::createClient();
        $client->loginUser($this->getAdminUser());

        $employeRepository = self::getContainer()->get('doctrine')->getRepository(Employe::class);
        $entityManager = self::getContainer()->get('doctrine')->getManager();

        $employe = new Employe();
        $employe->setNom('toDelete');
        $employe->setPrenom('prenom');
        $employe->setEmail('delete.test@example.com');
        $employe->setTelephone('0987654321');
        $employe->setAdresse('Adresse à supprimer');

        $competenceRepository = self::getContainer()->get('doctrine')->getRepository(Competences::class);
        $competence = $competenceRepository->findOneBy(['id' => 1]);
        $employe->addCompetence($competence);

        $entityManager->persist($employe);
        $entityManager->flush();

        $employeId = $employe->getId();

        $existingEmploye = $employeRepository->find($employeId);
        $this->assertNotNull($existingEmploye);

        $entityManager->remove($employe);
        $entityManager->flush();
        $entityManager->clear();

        $deletedEmploye = $employeRepository->find($employeId);
        $this->assertNull($deletedEmploye);
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
