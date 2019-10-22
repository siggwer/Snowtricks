<?php


namespace App\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use App\Form\ResetType;
use App\Entity\User;
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
     * @param Environment $templating
     * @param Swift_Mailer $mailer
     * @param FlashBagInterface $flashBag
     */
    public function __construct(UserRepository $userRepository, Environment $templating, Swift_Mailer $mailer, FlashBagInterface $flashBag)
    {
        $this->userRepository = $userRepository;
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
        $user =
        dd($data);
        $this->userRepository->resetPassword($data->getPassword(), $data->getPasswordToken());

    }
}