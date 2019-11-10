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
        $registerAt = 'date("Y-m-d H:i:s", strtotime(\'2019-10-31 09:20:35\'))';

        $user->setUsername($username);
        $user->setUsername($email);
        $user->setUsername($password);
        $user->setUsername($registerAt);

        $this->assertEquals('test', $user->getUsername());
        $this->assertEquals('test@yopmail.com', $user->getEmail());
        $this->assertEquals('sfJDLKSmdlfsmdlfjlmskDFLMsdjflmSDFLMlm\'', $user->getPassword());
        $this->assertEquals('date("Y-m-d H:i:s", strtotime(\'2019-10-31 09:20:35\'))', $user->getRegisteredAt());
    }
}