<?php

namespace App\Handler;

use App\Event\ForgotPasswordEmailEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Doctrine\ORM\NonUniqueResultException;
use App\Repository\UserRepository;
use Doctrine\ORM\ORMException;
use App\Services\Token;
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
     * @var Token
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
     * @param UserRepository $userRepository
     * @param Token $tokenService
     * @param EventDispatcherInterface $eventDispatcher
     * @param FlashBagInterface $flashBag
     */
    public function __construct(UserRepository $userRepository, Token $tokenService, EventDispatcherInterface $eventDispatcher, FlashBagInterface $flashBag)
    {
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
        $user = $this->userRepository->checkEmail($data->getEmail());

            if ($data->getEmail() === $user->getEmail()) {
                $passwordToken = $this->tokenService->generate();

                $this->userRepository->saveResetToken($data->getEmail(), $passwordToken);

                $this->eventDispatcher->dispatch(ForgotPasswordEmailEvent::NAME,
                    new ForgotPasswordEmailEvent($data->getEmail(), $passwordToken));

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