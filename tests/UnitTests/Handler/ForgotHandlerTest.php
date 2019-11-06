<?php

namespace App\Tests\UnitTests\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use App\Repository\UserRepository;
use App\Services\TokenGenerator;
use App\Handler\ForgotHandler;
use App\Model\Forgot;

/**
 * Class ForgotHandlerTest
 *
 * @package App\Tests\UnitTests\Handler
 */
class ForgotHandlerTest extends TestCase
{
    /**
     *
     */
    public function testHandle(

    ) {
        $handler = new ForgotHandler($this->createMock(UserRepository::class),
            $this->createMock(TokenGenerator::class),
            $this->createMock(FlashBagInterface::class),
            $this->createMock(EventDispatcherInterface::class)
        );

        $formFactory = $this->createMock(FormFactoryInterface::class);

        $form = $this->createMock(FormInterface::class);
        $form->method('handleRequest')->willReturnSelf();
        $form->method('isSubmitted')->willReturn(true);
        $form->method('isValid')->willReturn(true);

        $formFactory->method('create')->willReturn($form);

        $handler->setFormFactory($formFactory);

        $this->assertTrue(
            $handler->handle($this->createMock(Request::class), new Forgot())
        );
    }
}