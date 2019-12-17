<?php

namespace App\Tests\UnitTests\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use App\Entity\Picture;
use DateTimeImmutable;
use App\Entity\User;
use ReflectionClass;
use Exception;

/**
 * Class UserTest
 *
 * @package App\Tests\UnitTests\Entity
 */
class UserTest extends TestCase
{
    /**
     * @var
     */
    public $user;

    /**
     * @throws Exception
     */
    public function setUp()
    {
        $this->user = new User();
    }

    /**
     * @throws ReflectionException
     */
    public function testGetId()
    {
        $user = new User();
        $this->assertNull($user->getId());
        try {
            $reflecion = new ReflectionClass($user);
        } catch (ReflectionException $e) {
        }
        $property = $reflecion->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($user, '1');
        $this->assertEquals(1, $user->getId());
    }

    /**
     *
     */
    public function testGetUsername()
    {
        $this->user->setUsername('test');
        $result = $this->user->getUsername();
        $this->assertEquals('test', $result);
    }

    /**
     *
     */
    public function testGetEmail()
    {
        $this->user->setEmail('test@yopmail.com');
        $result = $this->user->getEmail();
        $this->assertEquals('test@yopmail.com', $result);
    }

    /**
     *
     */
    public function testGetPassword()
    {
        $this->user->setPassword('sfJDLKSmdlfsmdlfjlmskDFLMsdjflmSDFLMlm');
        $result = $this->user->getPassword();
        $this->assertEquals('sfJDLKSmdlfsmdlfjlmskDFLMsdjflmSDFLMlm', $result);
    }

    /**
     *
     */
    public function testGetPlainPassword()
    {
        $this->user->setPlainPassword('password');
        $result = $this->user->getPlainPassword();
        $this->assertEquals('password', $result);
    }

    /**
     *
     */
    public function testGetPasswordToken()
    {
        $this->user->setPasswordToken('qsùdqSDKùmsd%MSDKLQù');
        $result = $this->user->getPasswordToken();
        $this->assertEquals('qsùdqSDKùmsd%MSDKLQù', $result);
    }

    /**
     * @throws Exception
     */
    public function testGetRegisterAt()
    {
        $this->user->setRegisteredAt(new DateTimeImmutable());
        $result = $this->user->getRegisteredAt();
        $this->assertInstanceOf(DateTimeImmutable::class, $result);
    }

    /**
     *
     */
    public function testGetAvatar()
    {
        $this->user->setAvatar(new Picture());
        $result = $this->user->getAvatar();
        $this->assertInstanceOf(Picture::class, $result);
    }

    /**
     *
     */
    public function testGetUploadedFile()
    {
        $this->user->setUploadedFile(
            new UploadedFile(
                'public/images/image.png',
                '%kernel.project_dir%/public/uploads'
            )
        );
        $result = $this->user->getUploadedFile();
        $this->assertInstanceOf(UploadedFile::class, $result);
    }

    /**
     *
     */
    public function testGetToken()
    {
        $this->user->setToken('lmqsdkqqSDLMQdlùqSLQ');
        $result = $this->user->getToken();
        $this->assertEquals('lmqsdkqqSDLMQdlùqSLQ', $result);
    }

    /**
     *
     */
    public function testGetRole()
    {
        $this->user->setRole('user');
        $result = $this->user->getRole();
        $this->assertEquals('user', $result);
    }

    /**
     *
     */
    public function testGetRoles()
    {
        $this->assertEquals(['ROLE_USER'], $this->user->getRoles());
    }
}
