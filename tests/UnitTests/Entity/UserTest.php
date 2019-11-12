<?php

namespace App\Tests\UnitTests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Entity\User;
use Exception;

/**
 * Class UserTest
 *
 * @package App\Tests\UnitTests\Entity
 */
class UserTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testUser()
    {
        $user = new User();
        $username = 'test';
        $email = 'test@yopmail.com';
        $password = 'sfJDLKSmdlfsmdlfjlmskDFLMsdjflmSDFLMlm';
        $registerAt = new \DateTimeImmutable();

        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setRegisteredAt($registerAt);

        $this->assertEquals('test', $user->getUsername());
        $this->assertEquals('test@yopmail.com', $user->getEmail());
        $this->assertEquals('sfJDLKSmdlfsmdlfjlmskDFLMsdjflmSDFLMlm\'', $user->getPassword());
        $this->assertInstanceOf(\DateTimeImmutable::class, $user->getRegisteredAt());
    }
}