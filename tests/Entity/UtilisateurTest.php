<?php

namespace App\Tests\Entity;

use App\Entity\Utilisateur;
use App\Entity\Role;
use PHPUnit\Framework\TestCase;

class UtilisateurTest extends TestCase
{
    public function testUtilisateurCreation()
    {
        $utilisateur = new Utilisateur();
        
        // Vérification des valeurs initiales
        $this->assertNull($utilisateur->getId());
        $this->assertNull($utilisateur->getEmail());
        $this->assertNull($utilisateur->getPassword());
        $this->assertNull($utilisateur->getRole());
    }

    public function testSetAndGetEmail()
    {
        $utilisateur = new Utilisateur();
        $email = "test@example.com";

        $utilisateur->setEmail($email);

        $this->assertSame($email, $utilisateur->getEmail());
    }

    public function testSetAndGetPassword()
    {
        $utilisateur = new Utilisateur();
        $password = "securepassword";

        $utilisateur->setPassword($password);

        $this->assertSame($password, $utilisateur->getPassword());
    }

    public function testSetAndGetRole()
    {
        $utilisateur = new Utilisateur();
        $role = new Role();
        
        // Simulons une méthode getRole() dans Role
        $role->setRole("ROLE_ADMIN");
        
        $utilisateur->setRole($role);

        $this->assertSame($role, $utilisateur->getRole());
        $this->assertContains("ROLE_ADMIN", $utilisateur->getRoles());
    }

    public function testGetUserIdentifier()
    {
        $utilisateur = new Utilisateur();
        $email = "identifier@example.com";

        $utilisateur->setEmail($email);

        $this->assertSame($email, $utilisateur->getUserIdentifier());
    }

    public function testEraseCredentials()
    {
        $utilisateur = new Utilisateur();
        
        // Appel de la méthode (normalement elle ne fait rien)
        $utilisateur->eraseCredentials();

        // Pas d'assertion nécessaire car la méthode est vide, mais on vérifie qu'elle ne lève pas d'exception
        $this->assertTrue(true);
    }
}
