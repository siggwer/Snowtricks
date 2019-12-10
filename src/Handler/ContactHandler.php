<?php

namespace App\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use App\Event\ContactEvent;
use App\Form\ContactType;
use App\Model\Contact;

/**
 * Class ContactHandler
 *
 * @package App\Handler
 */
class ContactHandler extends AbstractHandler
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    /**
     * ContactHandler constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     * @param FlashBagInterface $flashBag
     */
    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        FlashBagInterface $flashBag
    ) {
        $this->eventDispatcher = $eventDispatcher;
        $this->flashBag = $flashBag;
    }

    /**
     * @return string
     */
    public function getFormType(): string
    {
        return ContactType::class;
    }

    /**
     * @param Contact $data
     */
    public function process($data = null): void
    {
        $event = new ContactEvent(
            $data->getMessage(),
            $data->getSubject(),
            $data->getName(),
            $data->getEmail()
        );
        $this->eventDispatcher->dispatch(
            $event,
            ContactEvent::NAME
        );

        $this->flashBag->add(
            'success',
            'Votre message a bien été envoyé.
                 Nous répondrons dans un délais de 48 heures.'
        );

    }
}
