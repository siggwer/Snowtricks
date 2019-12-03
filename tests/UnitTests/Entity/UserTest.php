<?php

namespace App\Tests\UnitTests\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use PHPUnit\Framework\TestCase;
use App\Entity\Picture;
use DateTimeImmutable;
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
        $plainPassword = 'password';
        $passwordToken = 'qsùdqSDKùmsd%MSDKLQù';
        $uploadedFile = new UploadedFile('public/images/image.png', '%kernel.project_dir%/public/uploads');
        $registerAt = new DateTimeImmutable();
        $avatar = new Picture();
        $token = 'lmqsdkqqSDLMQdlùqSLQ';
        $role = 'user';

        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setPlainPassword($plainPassword);
        $user->setPasswordToken($passwordToken);
        $user->setUploadedFile($uploadedFile);
        $user->setRegisteredAt($registerAt);
        $user->setAvatar($avatar);
        $user->setToken($token);
        $user->setRole($role);

        $this->assertEquals('test', $user->getUsername());
        $this->assertEquals('test@yopmail.com', $user->getEmail());
        $this->assertEquals('sfJDLKSmdlfsmdlfjlmskDFLMsdjflmSDFLMlm', $user->getPassword());
        $this->assertEquals('password', $user->getPlainPassword());
        $this->assertEquals('qsùdqSDKùmsd%MSDKLQù', $user->getPasswordToken());
        $this->assertInstanceOf(UploadedFile::class, $user->getUploadedFile());
        $this->assertInstanceOf(DateTimeImmutable::class, $user->getRegisteredAt());
        $this->assertInstanceOf(Picture::class, $user->getAvatar());
        $this->assertEquals('lmqsdkqqSDLMQdlùqSLQ', $user->getToken());
        $this->assertEquals('user', $user->getRole());

    }
}