<?php

namespace App\Tests\UnitTests\Handler;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use App\Handler\AbstractHandler;
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
     * @return mixed
     */
    abstract public function getData();

    /**
     * @return array
     */
    abstract public function getFormData(): array;

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

        $request = $this->createMock(Request::class);
        $request->request = new ParameterBag($this->getFormData());

        $this->assertTrue(
            $handler->handle($this->createMock(Request::class), $this->getData())
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

//        $request = $this->createMock(Request::class);
//        $request->request = new ParameterBag($this->getFormData());

        $this->assertFalse(
            $handler->handle($this->createMock(Request::class), $this->getData())
        );
    }
}