<?php

namespace App\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;
use App\Event\UpdateTrickEmailEvent;
use App\Form\UpdateTrickType;
use App\Entity\Trick;

/**
 * Class UpdateTrickHandler
 *
 * @package App\Handler
 */
class UpdateTrickHandler extends AbstractHandler
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
     * UpdateTrickHandler constructor.
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
        return UpdateTrickType::class;
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
            $event = new  UpdateTrickEmailEvent($data->getAuthor()->getEmail(), $data->getSlug());
            $this->eventDispatcher->dispatch(
                $event,
                UpdateTrickEmailEvent::NAME
            );

            $this->flashBag->add(
                'success',
                'Le trick a bien été modifié, un email de confirmation t\'a été envoyé.'
            );

            return;
        }

        $this->flashBag->add(
            'error',
            'Une erreur est survenue. Merce de réessayer.'
        );
    }
}
