<?php


namespace App\Handler;

use Doctrine\ORM\EntityManager;
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
     * @var EntityManagerInterface
     */
    private $entityMananger;

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
     * @param EntityManagerInterface $entityManager
     * @param Environment $templating
     * @param Swift_Mailer $mailer
     * @param FlashBagInterface $flashBag
     */
    public function __construct(EntityManagerInterface $entityManager, Environment $templating, Swift_Mailer $mailer, FlashBagInterface $flashBag)
    {
        $this->entityMananger= $entityManager;
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
        $data->setPasswordToken(null);
        $this->entityMananger->flush();
        $this->flashBag->add(
            'success',
            'Votre mot de passe a bien été changé.'
        );
    }
}