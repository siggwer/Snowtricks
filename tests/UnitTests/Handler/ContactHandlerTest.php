<?php

namespace App\Tests\UnitTests\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use App\Handler\AbstractHandler;
use App\Handler\ContactHandler;
use App\Model\Contact;

/**
 * Class ContactHandlerTest
 *
 * @package App\Tests\UnitTests\Handler
 */
class ContactHandlerTest extends AbstractTestHandler
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
        $contact = new Contact();

        return new Contact();
    }

    /**
     * @return array
     */
    public function getFormData(): array
    {
        return [
            'message' => 'message',
            'subject' => 'subject',
            'name' => 'name',
            'email' => 'test@email.com'
        ];
    }
}