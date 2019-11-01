<?php

namespace App\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Doctrine\ORM\NonUniqueResultException;
use App\Event\ForgotPasswordEmailEvent;
use App\Repository\UserRepository;
use App\Services\TokenGenerator;
use Doctrine\ORM\ORMException;
use App\Form\ForgotType;
use App\Model\Forgot;

/**
 * Class ForgotHandler
 *
 * @package App\Handler
 */
class ForgotHandler extends AbstractHandler
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var TokenGenerator
     */
    private $tokenService;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    /**
     * ForgotHandler constructor.
     *
     * @param UserRepository           $userRepository
     * @param TokenGenerator           $tokenService
     * @param EventDispatcherInterface $eventDispatcher
     * @param FlashBagInterface        $flashBag
     */
    public function __construct(
        UserRepository $userRepository,
        TokenGenerator $tokenService,
        EventDispatcherInterface $eventDispatcher,
        FlashBagInterface $flashBag
    ) {
        $this->userRepository = $userRepository;
        $this->tokenService = $tokenService;
        $this->eventDispatcher = $eventDispatcher;
        $this->flashBag = $flashBag;
    }

    /**
     * @return string
     */
    public function getFormType(): string
    {
        return ForgotType::class;
    }

    /**
     * @param Forgot $data
     *
     * @throws NonUniqueResultException
     * @throws ORMException
     */
    public function process($data = null): void
    {
        $this->userRepository->checkEmail($data->getEmail());

        $passwordToken = $this->tokenService->generate();

        if ($this->userRepository->saveResetToken($data->getEmail(), $passwordToken)) {
            $this->eventDispatcher->dispatch(
                ForgotPasswordEmailEvent::NAME,
                new ForgotPasswordEmailEvent($data->getEmail(), $passwordToken)
            );

            $this->flashBag->add(
                'success',
                'Un email t\'a été envoyé pour récupérer ton mot de passe.'
            );

            return;
        }

        $this->flashBag->add(
            'error',
            'Votre email n\'est pas reconnu'
        );
    }
}
