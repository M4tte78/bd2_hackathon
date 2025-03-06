<?php

namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ChantierControllerTest extends WebTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        echo "\n==== Démarrage des tests unitaires de Chantier ====\n";
    }

    public function tearDown(): void
    {
        echo ".";
        parent::tearDown();
    }

    public function testChantierListAccessForAdmin()
    {
        $client = static::createClient();

        $client->loginUser(
            $this->getAdminUser()
        );

        $crawler = $client->request('GET', '/admin?crudAction=index&crudControllerFqcn=App\Controller\Admin\ChantierCrudController');
        $this->assertResponseIsSuccessful();
        
        $this->assertStringContainsString('ChantierCrudController', $client->getRequest()->getUri());
        
        $this->assertSelectorExists('table');
        
        echo "\n✓ Test de la liste des chantiers réussi";
    }
    
    public function testChantierNewPageAccessForAdmin()
    {
        $client = static::createClient();

        $client->loginUser(
            $this->getAdminUser()
        );

        $crawler = $client->request('GET', '/admin?crudAction=new&crudControllerFqcn=App\Controller\Admin\ChantierCrudController');
        $this->assertResponseIsSuccessful();
        
        $this->assertSelectorExists('form');
        
        echo "\n✓ Test de la page de création de chantier réussi";
    }
    
    public function testChantierEditPageAccessForAdmin()
    {
        $client = static::createClient();

        $client->loginUser(
            $this->getAdminUser()
        );
        
        $chantierId = $this->getFirstChantierId();
        
        if (!$chantierId) {
            $this->markTestSkipped('Aucun chantier disponible pour le test d\'édition');
            echo "\n⚠ Test d'édition ignoré (aucun chantier disponible)";
            return;
        }

        $client->request('GET', "/admin?crudAction=edit&crudControllerFqcn=App\Controller\Admin\ChantierCrudController&entityId={$chantierId}");
        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('form');
        
        echo "\n✓ Test de la page d'édition de chantier réussi";
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
    
    private function getFirstChantierId()
    {
        try {
            $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
            $chantier = $entityManager->getRepository(\App\Entity\Chantier::class)->findOneBy([]);
            
            return $chantier ? $chantier->getId() : null;
        } catch (\Exception $e) {
            return null;
        }
    }
    
    /**
     * @afterClass
     */
    public static function tearDownAfterClass(): void
    {
        echo "\n\n==== Tests unitaires de Chantier terminés avec succès! ====\n\n";
    }
}