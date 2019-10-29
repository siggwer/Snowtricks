<?php

namespace App\Handler;

use App\Entity\User;
use App\Form\ResetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

/**
 * Class ResetHandler.
 */
class ResetHandler extends AbstractHandler
{
    /**
     * @var EntityManagerInterface
     */
    private $entityMananger;

    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    /**
     * ResetHandler constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param FlashBagInterface      $flashBag
     */
    public function __construct(EntityManagerInterface $entityManager, FlashBagInterface $flashBag)
    {
        $this->entityMananger = $entityManager;
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
