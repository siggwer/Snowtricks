<?php

namespace App\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\RegistrationFormType;
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
     * @var FlashBagInterface
     */
    private $flashBag;

    /**
     * RegistrationHandler constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param FlashBagInterface      $flashBag
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        FlashBagInterface $flashBag
    ) {
        $this->entityManager = $entityManager;
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
        $this->entityManager->persist($data);
        $this->entityManager->flush();

        $this->flashBag->add(
            'success',
            'Votre compte a bien été créé.'
        );
    }
}
