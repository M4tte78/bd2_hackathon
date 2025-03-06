<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EmployeControllerTest extends WebTestCase
{
    public function testEmployePageIsUp()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/employe');
    
        dump($crawler->filter('h1')->text()); // Affiche le contenu du <h1>
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Liste des employés');
    }
}
