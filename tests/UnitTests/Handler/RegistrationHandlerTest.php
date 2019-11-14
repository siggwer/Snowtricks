<?php

namespace App\Tests\UnitTests\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Handler\RegistrationHandler;
use App\Handler\AbstractHandler;
use App\Services\TokenGenerator;
use App\Entity\User;
use Exception;

/**
 * Class RegistrationHandlerTest
 *
 * @package App\Tests\UnitTests\Handler
 */
class RegistrationHandlerTest extends AbstractTestHandler
{
    /**
     * @return AbstractHandler
     */
    public function getHandler(): AbstractHandler
    {
        return new RegistrationHandler(
            $this->createMock(EntityManagerInterface::class),
            $this->createMock(EventDispatcherInterface::class),
            $this->createMock(TokenGenerator::class),
            $this->createMock(FlashBagInterface::class)
        );
    }

    /**
     * @return User|mixed
     *
     * @throws Exception
     */
    public function getData()
    {
        return new User();
    }

    /**
     * @return array
     */
    public function getFormData(): array
    {
        return [
          'username' => 'test',
          'email' => 'test@email.com',
          'plainPasswordFirst' => 'password',
          'plainPasswordSecond' => 'password',
        ];
    }
}