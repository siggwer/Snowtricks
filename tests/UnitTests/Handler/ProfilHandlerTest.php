<?php

namespace App\Tests\UnitTests\Handler;

use App\Handler\ProfilHandler;
use Doctrine\ORM\EntityManagerInterface;
//use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Security;

/**
 * Class ProfilHandlerTest
 *
 * @package App\Tests\UnitTests\Handler
 */
class ProfilHandlerTest extends TestCase
{
    /**
     *
     */
    public function testHandle(

    ) {
        $handler = new ProfilHandler($this->createMock(EntityManagerInterface::class, FlashBagInterface::class, Security::class));

        $formFactory = $this->createMock(FormFactoryInterface::class);

        $form = $this->createMock(FormInterface::class);
        $form->method("handleRequest")->willReturnSelf();
        $form->method("isSubmitted")->willReturn(true);
        $form->method("isValid")->willReturn(true);

        $formFactory->method("create")->willReturn($form);

        $handler->setFormFactory($formFactory);

        $this->assertTrue(
            $handler->handle($this->createMock(Request::class))
        );
    }

}