<?php


namespace App\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\ResetType;
use App\Services\Token;
use Twig\Environment;
use Swift_Mailer;

/**
 * Class ResetHandler
 *
 * @package App\Handler
 */
class ResetHandler extends AbstractHandler
{
    /**
     * @var
     */
    private $userRepository;

    /**
     * @var Environment
     */
    private $templating;

    /**
     * @var Token
     */
    private $tokenService;

    /**
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    /**
     * ResetHandler constructor.
     *
     * @param UserRepository $userRepository
     * @param Token $tokenService
     * @param Environment $templating
     * @param Swift_Mailer $mailer
     * @param FlashBagInterface $flashBag
     */
    public function __construct(UserRepository $userRepository, Token $tokenService, Environment $templating, Swift_Mailer $mailer, FlashBagInterface $flashBag)
    {
        $this->userRepository = $userRepository;
        $this->tokenService = $tokenService;
        $this->templating = $templating;
        $this->mailer = $mailer;
        $this->flashBag = $flashBag;
    }

    /**
     * @return string
     */
    public function getFormType(): string
    {
        return ResetType::class;
    }

    /**
     * @param User $data
     */
    public function process($data = null): void
    {

    }
}