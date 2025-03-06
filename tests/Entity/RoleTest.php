<?php

namespace App\Tests\Entity;

use App\Entity\Role;
use PHPUnit\Framework\TestCase;

class RoleTest extends TestCase
{
    public function testRoleCreation()
    {
        $role = new Role();

        // Vérification des valeurs initiales
        $this->assertNull($role->getId());
        $this->assertNull($role->getRole());
    }

    public function testSetAndGetRole()
    {
        $role = new Role();
        $roleValue = "ROLE_ADMIN";

        $role->setRole($roleValue);

        $this->assertSame($roleValue, $role->getRole());
    }

    public function testToString()
    {
        $role = new Role();
        $roleValue = "ROLE_USER";

        $role->setRole($roleValue);

        $this->assertSame($roleValue, (string) $role);
    }
}
