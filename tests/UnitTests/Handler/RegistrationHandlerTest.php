<?php

namespace App\Tests\UnitTests\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Handler\RegistrationHandler;
use App\Handler\AbstractHandler;
use App\Services\TokenGenerator;

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
}