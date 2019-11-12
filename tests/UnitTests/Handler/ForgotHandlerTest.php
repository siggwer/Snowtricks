<?php

namespace App\Tests\UnitTests\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use App\Repository\UserRepository;
use App\Services\TokenGenerator;
use App\Handler\AbstractHandler;
use App\Handler\ForgotHandler;

/**
 * Class ForgotHandlerTest
 *
 * @package App\Tests\UnitTests\Handler
 */
class ForgotHandlerTest extends AbstractTestHandler
{
    /**
     * @return AbstractHandler
     */
    public function getHandler(): AbstractHandler
    {
        return new ForgotHandler(
            $this->createMock(UserRepository::class),
            $this->createMock(TokenGenerator::class),
            $this->createMock(EventDispatcherInterface::class),
            $this->createMock(FlashBagInterface::class)
        );
    }
}