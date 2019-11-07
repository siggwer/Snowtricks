<?php

namespace App\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\RegistrationFormType;
use App\Event\RegisterEmailEvent;
use App\Services\TokenGenerator;
use App\Entity\User;

/**
 * Class RegistrationHandler
 *
 * @package App\Handler
 */
class RegistrationHandler extends AbstractHandler
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
     * @var TokenGenerator
     */
    private $tokenService;

    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    /**
     * RegistrationHandler constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param EventDispatcherInterface $eventDispatcher
     * @param TokenGenerator $tokenService
     * @param FlashBagInterface $flashBag
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        EventDispatcherInterface $eventDispatcher,
        TokenGenerator $tokenService,
        FlashBagInterface $flashBag
    ) {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
        $this->tokenService = $tokenService;
        $this->flashBag = $flashBag;
    }

    /**
     * @return string
     */
    public function getFormType(): string
    {
        return RegistrationFormType::class;
    }

    /**
     * @param User $data
     */
    public function process($data = null): void
    {
        $data->setToken($this->tokenService->generate());

        $this->entityManager->persist($data);
        $this->entityManager->flush();

        if($data !== null) {
            $this->eventDispatcher->dispatch(
                RegisterEmailEvent::NAME,
                new RegisterEmailEvent($data->getEmail(), $data->getToken()));

            $this->flashBag->add(
                'success',
                'Ton compte a bien été créé, un email t\'a été envoyé pour la valider.'
            );
        return;
        }
        $this->flashBag->add(
            'error',
            'Une erreur s\'est produite, merci de réessayer ultérieurement.'
        );
    }
}
