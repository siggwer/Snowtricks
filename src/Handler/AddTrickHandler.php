<?php

namespace App\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;
use App\Event\AddTrickEmailEvent;
use App\Form\TrickType;
use App\Entity\Trick;

/**
 * Class AddTrickHandler.
 */
class AddTrickHandler extends AbstractHandler
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    /**
     * @var Security
     */
    private $security;

    /**
     * AddTrickHandler constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param EventDispatcherInterface $eventDispatcher
     * @param FlashBagInterface $flashBag
     * @param Security $security
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        EventDispatcherInterface $eventDispatcher,
        FlashBagInterface $flashBag,
        Security $security
    ) {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
        $this->flashBag = $flashBag;
        $this->security = $security;
    }

    /**
     * @return string
     */
    public function getFormType(): string
    {
        return TrickType::class;
    }

    /**
     * @param Trick $data
     */
    public function process($data = null): void
    {
        $data->setAuthor($this->security->getUser());

        $this->entityManager->persist($data);
        $this->entityManager->flush();

        if ($data->getSlug()) {
            $this->eventDispatcher->dispatch(
                AddTrickEmailEvent::NAME,
                new AddTrickEmailEvent($data->getAuthor()->getEmail(), $data->getSlug())
            );

            $this->flashBag->add(
                'success',
                'Le trick a bien été crée, un email de confirmation t\'a été envoyé.'
            );

            return;
        }

        $this->flashBag->add(
            'error',
            'Une erreur est survenue. Merce de réessayer.'
        );
    }
}
