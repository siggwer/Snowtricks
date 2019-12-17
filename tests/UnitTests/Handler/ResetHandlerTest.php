<?php

namespace App\Tests\UnitTests\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Handler\AbstractHandler;
use App\Handler\ResetHandler;
use App\Entity\User;
use Exception;

/**
 * Class ResetHandlerTest
 *
 * @package App\Tests\UnitTests\Handler
 */
class ResetHandlerTest extends AbstractHandlerTest
{
    /**
     * @return AbstractHandler
     */
    public function getHandler(): AbstractHandler
    {
        return new ResetHandler(
            $this->createMock(EntityManagerInterface::class),
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
           'reset' => [
                'plainPassword' => ["first" => 'password', 'second' => 'password'],
           ]
        ];
    }

    public function hydrate(Request $request): FormInterface
    {
        $this->data->setPlainPassword($request->request->get('reset')['plainPassword']['first']);
        return $this->form;
    }
}
