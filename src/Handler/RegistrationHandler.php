<?php

namespace App\Handler;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

/**
 * Class RegistrationHandler
 *
 * @package App\Handler
 */
class RegistrationHandler
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var FormInterface
     */
    private $form;

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
     * @param FormFactoryInterface   $formFactory
     * @param EntityManagerInterface $entityManager
     * @param FlashBagInterface      $flashBag
     */
    public function __construct(FormFactoryInterface $formFactory, EntityManagerInterface $entityManager, FlashBagInterface $flashBag)
    {
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->flashBag = $flashBag;
    }

    /**
     * @param User    $user
     * @param Request $request
     *
     * @return bool
     */
    public function handle(User $user, Request $request) : bool
    {
        $this->form = $this->formFactory->create(RegistrationFormType::class, $user)->handleRequest($request);

        if ($this->form->isSubmitted() &&  $this->form->isValid()) {
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->flashBag->add(
                'success',
                'Votre compte a bien été créé.'
            );

            return true;
        }

        return false;
    }

    /**
     * @return FormView
     */
    public function createView() : FormView
    {
        return  $this->form->createView();
    }
}
