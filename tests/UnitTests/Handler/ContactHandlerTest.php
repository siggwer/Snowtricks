<?php

namespace App\Tests\UnitTests\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use App\Handler\AbstractHandler;
use App\Handler\ContactHandler;
use App\Model\Contact;

/**
 * Class ContactHandlerTest
 *
 * @package App\Tests\UnitTests\Handler
 */
class ContactHandlerTest extends AbstractHandlerTest
{
    /**
     * @return AbstractHandler
     */
    public function getHandler(): AbstractHandler
    {
        return new ContactHandler(
            $this->createMock(EventDispatcherInterface::class),
            $this->createMock(FlashBagInterface::class)
        );
    }

    /**
     * @return Contact|mixed
     */
    public function getData()
    {
        return new Contact();
    }

    /**
     * @param Request $request
     *
     * @return FormInterface
     */
    public function hydrate(Request $request): FormInterface
    {
        $this->data->setMessage($request->request->get("contact")["message"]);
        $this->data->setEmail($request->request->get("contact")["email"]);
        $this->data->setSubject($request->request->get("contact")["subject"]);
        $this->data->setName($request->request->get("contact")["name"]);
        return $this->form;
    }

    /**
     * @return array
     */
    public function getFormData(): array
    {
        return [
            'contact' => [
                'message' => 'message',
                'subject' => 'subject',
                'name' => 'name',
                'email' => 'test@email.com'
            ]
        ];
    }
}
