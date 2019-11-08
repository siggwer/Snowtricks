<?php

namespace App\Tests\UnitTests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Entity\User;

class UserTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testUser(

    ) {
        $user = new User();
        $username = 'test';

        $user->setUsername($username);
        $this->assertEquals('test', $user->getUsername());
    }
}