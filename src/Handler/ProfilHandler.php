<?php

namespace App\Handler;

use App\Entity\User;
use App\Form\AvatarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Security;

/**
 * Class ProfilHandler.
 */
class ProfilHandler extends AbstractHandler
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    /**
     * ProfilHandler constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param FlashBagInterface      $flashBag
     * @param Security               $security
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        FlashBagInterface $flashBag,
        Security $security
    ) {
        $this->entityManager = $entityManager;
        $this->flashBag = $flashBag;
        $this->security = $security;
    }

    /**
     * @return string
     */
    public function getFormType(): string
    {
        return AvatarType::class;
    }

    /**
     * @param User $data
     */
    public function process($data = null): void
    {
        $data->getUsername($this->security->getUser());

        $this->entityManager->persist($data);
        $this->entityManager->flush();

        $this->flashBag->add(
            'success',
            'Votre avatar a bien été modifié'
        );
    }
}
