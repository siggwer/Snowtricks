<?php

namespace App\Handler;

use App\Entity\Trick;
use App\Form\TrickType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Security;

/**
 * Class AddTrickHandler.
 */
class AddTrickHandler extends AbstractHandler
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
     * @var Security
     */
    private $security;

    /**
     * AddTrickHandler constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param FlashBagInterface      $flashBag
     * @param Security               $security
     */
    public function __construct(EntityManagerInterface $entityManager, FlashBagInterface $flashBag, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->flashBag = $flashBag;
        $this->security = $security;
    }

    /**
     * @return string
     */
    public function getFormType(): string
    {
        return TrickType::class;
    }

    /**
     * @param Trick $data
     */
    public function process($data = null): void
    {
        $data->setAuthor($this->security->getUser());

        $this->entityManager->persist($data);
        $this->entityManager->flush();

        $this->flashBag->add(
            'success',
            'Le trick a bien été crée.'
        );
    }
}
