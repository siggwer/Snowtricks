<?php

namespace App\Tests\UnitTests\Handler;

use App\Model\Forgot;
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

    /**
     * @return Forgot|mixed
     */
    public function getData()
    {
       return new Forgot();
    }

    /**
     * @return array
     */
    public function getFormData(): array
    {
        return [
          'email' => 'test@email.com'
        ];
    }
}