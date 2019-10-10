<?php

namespace App\Handler;

use App\Entity\Trick;
use App\Form\TrickType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

/**
 * Class AddTrickHandler
 *
 * @package App\Handler
 */
class AddTrickHandler
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
     * @var Trick
     */
    private $Trick;

    /**
     * AddTrickHandler constructor.
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

    public function handle(Request $request, Trick $trick) : bool
    {
        $this->form = $this->formFactory->create(
            TrickType::class,
            $trick,
            [
                'validation_groups' => ['Default', "add"]
            ]
        )->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $this->entityManager->persist($trick);
            $this->entityManager->flush();

            $this->flashBag->add(
                'success',
                'Le trick a bien été crée.'
            );

            return true;
        }

        return false;
    }

    /**
     * @param Trick $trick
     *
     * @return string
     */
    public function getSlug(Trick $trick): string
    {
        return $trick->getSlug();
    }

    /**
     * @return FormView
     */
    public function createView(): FormView
    {
        return  $this->form->createView();
    }
}
