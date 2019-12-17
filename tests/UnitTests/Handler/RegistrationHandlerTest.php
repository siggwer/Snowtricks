<?php

namespace App\Tests\UnitTests\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
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
class RegistrationHandlerTest extends AbstractHandlerTest
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
            'registration' => [
                'username' => 'test',
                'email' => 'test@email.com',
                'plainPassword' => ["first" => 'password', 'second' => 'password'],
            ]
        ];
    }

    public function hydrate(Request $request): FormInterface
    {
        $this->data->setUsername($request->request->get('registration')['username']);
        $this->data->setEmail($request->request->get('registration')['email']);
        $this->data->setPlainPassword($request->request->get('registration')['plainPassword']['first']);
        return $this->form;
    }
}
