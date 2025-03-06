<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EmployeControllerTest extends WebTestCase
{
    public function testEmployePageIsUp()
    {
        $client = static::createClient();
        $client->request('GET', '/employe');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Liste des employés');
    }
}
