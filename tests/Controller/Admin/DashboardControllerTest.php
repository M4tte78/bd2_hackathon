<?php

namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DashboardControllerTest extends WebTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        echo "\n==== Démarrage des tests unitaires du Dashboard ====\n";
    }

    public function tearDown(): void
    {
        echo ".";
        parent::tearDown();
    }

    public function testDashboardAccessForAdmin()
    {
        $client = static::createClient();

        $client->loginUser(
            $this->getAdminUser()
        );

        $client->request('GET', '/admin');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'TEAMBUILD');
        
        echo "\n✓ Test d'accès au dashboard réussi";
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
    
    /**
     * @afterClass
     */
    public static function tearDownAfterClass(): void
    {
        echo "\n\n==== Tests unitaires du Dashboard terminés avec succès! ====\n\n";
    }
}