<?php

namespace App\Tests\UnitTests\Handler;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormConfigInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Form;
use App\Handler\AbstractHandler;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractHandlerTest
 *
 * @package App\Tests\UnitTests\Handler
 */
abstract class AbstractHandlerTest extends TestCase
{
    /**
     * @var Form
     */
    protected $form;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * @return AbstractHandler
     */
    abstract public function getHandler() : AbstractHandler;

    /**
     * @return mixed
     */
    abstract public function getData();

    /**
     * @return array
     */
    abstract public function getFormData() : array;

    /**
     * @param Request $request
     *
     * @return FormInterface
     */
    abstract public function hydrate(Request $request) : FormInterface;

    /**
     *
     */
    public function testHandleIsTrue()
    {
        $handler = $this->getHandler();

        $formFactory = $this->createMock(FormFactoryInterface::class);

        $formConfig = $this->createMock(FormConfigInterface::class);
        $formConfig->method('getDataLocked')->willReturn(false);
        $formConfig->method('getModelTransformers')->willReturn([]);
        $formConfig->method('getEventDispatcher')->willReturn(
            $this->createMock(EventDispatcher::class)
        );

        /**
 * @var Form form 
*/
        $this->form = $this->getMockBuilder(Form::class)
            ->setConstructorArgs([$formConfig])
            ->setMethods(
                [
                'handleRequest',
                'isSubmitted',
                'isValid'
                ]
            )
            ->getMock();

        $this->data = $this->getData();

        $this->form->method('handleRequest')->willReturnCallback([$this, 'hydrate']);
        $this->form->method('isSubmitted')->willReturn(true);
        $this->form->method('isValid')->willReturn(true);
        $this->form->setData($this->data);

        $formFactory->method('create')->willReturn($this->form);

        $handler->setFormFactory($formFactory);

        $request = $this->createMock(Request::class);
        $request->request = new ParameterBag($this->getFormData());

        $this->assertTrue(
            $handler->handle($request, $this->data)
        );
    }

    /**
     *
     */
    public function testHandleIsFalse()
    {
        $handler = $this->getHandler();

        $formFactory = $this->createMock(FormFactoryInterface::class);

        $formConfig = $this->createMock(FormConfigInterface::class);
        $formConfig->method('getDataLocked')->willReturn(false);
        $formConfig->method('getModelTransformers')->willReturn([]);
        $formConfig->method('getEventDispatcher')->willReturn(
            $this->createMock(EventDispatcher::class)
        );

        /**
 * @var Form form 
*/
        $this->form = $this->getMockBuilder(Form::class)
            ->setConstructorArgs([$formConfig])
            ->setMethods(
                [
                'handleRequest',
                'isSubmitted',
                'isValid'
                ]
            )
            ->getMock();

        $this->form->method('handleRequest')->willReturnSelf();
        $this->form->method('isSubmitted')->willReturn(false);
        $this->form->method('isValid')->willReturn(false);
        $this->form->setData($this->data);

        $formFactory->method('create')->willReturn($this->form);

        $handler->setFormFactory($formFactory);

        $request = $this->createMock(Request::class);
        $request->request = new ParameterBag($this->getFormData());

        $message = 'Une erreur est survenue';

        $this->assertFalse(
            $handler->handle($request, $this->getData())
        );
    }
}
