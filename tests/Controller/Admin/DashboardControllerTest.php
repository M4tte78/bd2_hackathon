<?php

namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DashboardControllerTest extends WebTestCase
{
    public function testDashboardAccessForAdmin()
    {
        $client = static::createClient();

        $client->loginUser(
            $this->getAdminUser()
        );

        $client->request('GET', '/admin');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'TEAMBUILD');
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
