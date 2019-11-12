<?php

namespace App\Tests\UnitTests\Handler;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use App\Handler\AbstractHandler;
use App\Entity\User;
use Exception;

/**
 * Class AbstractTestHandler
 *
 * @package App\Tests\UnitTests\Handler
 *
 */
abstract class AbstractTestHandler extends TestCase
{
    /**
     * @return AbstractHandler
     */
    abstract public function getHandler(): AbstractHandler;

    /**
     * @throws Exception
     */
    public function testHandleIsTrue()
    {
        $handler = $this->getHandler();

        $formFactory = $this->createMock(FormFactoryInterface::class);

        $form = $this->createMock(FormInterface::class);
        $form->method('handleRequest')->willReturnSelf();
        $form->method('isSubmitted')->willReturn(true);
        $form->method('isValid')->willReturn(true);

        $formFactory->method('create')->willReturn($form);

        $handler->setFormFactory($formFactory);

        $this->assertTrue(
            $handler->handle($this->createMock(Request::class), new User)
        );
    }

    /**
     * @throws Exception
     */
    public function testHandleIsFalse()
    {
        $handler = $this->getHandler();

        $formFactory = $this->createMock(FormFactoryInterface::class);

        $form = $this->createMock(FormInterface::class);
        $form->method('handleRequest')->willReturnSelf();
        $form->method('isSubmitted')->willReturn(false);
        $form->method('isValid')->willReturn(false);

        $formFactory->method('create')->willReturn($form);

        $handler->setFormFactory($formFactory);

        $this->assertFalse(
            $handler->handle($this->createMock(Request::class), new User)
        );
    }
}