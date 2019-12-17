<?php

namespace App\Tests\UnitTests\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use App\Repository\UserRepository;
use App\Services\TokenGenerator;
use App\Handler\AbstractHandler;
use App\Handler\ForgotHandler;
use App\Model\Forgot;

/**
 * Class ForgotHandlerTest
 *
 * @package App\Tests\UnitTests\Handler
 */
class ForgotHandlerTest extends AbstractHandlerTest
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
            'forgot' => [
                'email' => 'test@email.com'
            ]
        ];
    }

    /**
     * @param Request $request
     *
     * @return FormInterface
     */
    public function hydrate(Request $request): FormInterface
    {
        $this->data->setEmail($request->request->get("forgot")["email"]);
        return $this->form;
    }
}
