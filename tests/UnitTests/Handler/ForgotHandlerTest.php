<?php

namespace App\Tests\UnitTests\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\NonUniqueResultException;
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
//    public function testHandle(
//
//    ) {
//        $handler = new ForgotHandler($this->createMock(UserRepository::class),
//            $this->createMock(TokenGenerator::class),
//            $this->createMock(EventDispatcherInterface::class),
//            $this->createMock(FlashBagInterface::class)
//        );
//
//        $formFactory = $this->createMock(FormFactoryInterface::class);
//
//        $form = $this->createMock(FormInterface::class);
//        $form->method('handleRequest')->willReturnSelf();
//        $form->method('isSubmitted')->willReturn(true);
//        $form->method('isValid')->willReturn(true);
//
//        $formFactory->method('create')->willReturn($form);
//
//        $handler->setFormFactory($formFactory);
//
//        $this->assertTrue(
//            $handler->handle($this->createMock(Request::class), new Forgot())
//        );
//    }

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var TokenGenerator
     */
    private $tokenService;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    /**
     *
     */
    public function setUp()
    {
        $this->userRepository = $this->createMock(
            UserRepository::class
        );
        $this->flashBag = $this->createMock(
            FlashBagInterface::class
        );
        $this->eventDispatcher = $this->createMock(
            EventDispatcherInterface::class
        );
        $this->tokenService = $this->createMock(
            TokenGenerator::class
        );
    }

    /**
     *
     */
    public function testConstruct()
    {
        $forgotPasswordHandler = new ForgotHandler(
            $this->userRepository,
            $this->tokenService,
            $this->eventDispatcher,
            $this->flashBag
        );
        static::assertInstanceOf(
            ForgotHandler::class,
            $forgotPasswordHandler
        );
    }

    /**
     * @throws NonUniqueResultException
     */
    public function testHandlerIsTrue()
    {
//        $form = $this->createMock(FormInterface::class);
//        $forgotPasswordHandler = new ForgotHandler(
//            $this->userRepository,
//            $this->tokenService,
//            $this->eventDispatcher,
//            $this->flashBag
//        );
//        static::assertTrue(true, $forgotPasswordHandler->handle(
//            $form, new Forgot()
//        ));

        $handler = new ForgotHandler($this->createMock(UserRepository::class),
            $this->createMock(TokenGenerator::class),
            $this->createMock(EventDispatcherInterface::class),
            $this->createMock(FlashBagInterface::class)
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

    /**
     * @throws NonUniqueResultException
     */
    public function testHandlerIsFalse()
    {
        $handler = new ForgotHandler($this->createMock(UserRepository::class),
            $this->createMock(TokenGenerator::class),
            $this->createMock(EventDispatcherInterface::class),
            $this->createMock(FlashBagInterface::class)
        );

        $formFactory = $this->createMock(FormFactoryInterface::class);

        $form = $this->createMock(FormInterface::class);
        $form->method('handleRequest')->willReturnSelf();
        $form->method('isSubmitted')->willReturn(false);
        $form->method('isValid')->willReturn(false);

        $formFactory->method('create')->willReturn($form);

        $handler->setFormFactory($formFactory);

        $this->assertFalse(
            $handler->handle($this->createMock(Request::class), new Forgot())
        );
    }
}