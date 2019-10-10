<?php

namespace App\Handler;

use App\Form\ContactType;
use App\Model\Contact;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class ContactHandler
 *
 * @package App\Handler
 */
class ContactHandler
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
     * ContactHandler constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param FlashBagInterface    $flashBag
     * @param Swift_Mailer         $mailer
     */
    public function __construct(FormFactoryInterface $formFactory, FlashBagInterface $flashBag, Swift_Mailer $mailer, Environment $templating)
    {
        $this->formFactory = $formFactory;
        $this->templating = $templating;
        $this->mailer = $mailer;
        $this->flashBag = $flashBag;
    }

    /**
     * @param Contact $contact
     * @param Request $request
     *
     * @return bool
     */
    public function handle(Contact $contact, Request $request) : bool
    {
        $this->form = $this->formFactory->create(ContactType::class, $contact)->handleRequest($request);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $message = new Swift_Message();

            try {
                $message
                    ->setTo('admin.snowtrick@yopmail.com', 'Contact snowtricks')
                    ->setFrom('admin.snowtrick@yopmail.com', 'Contact snowtricks')
                    ->setReplyTo($contact->getEmail(), $contact->getName())
                    ->setBody(
                        $this->templating->render(
                            'contact/contact_email.html.twig',
                            [
                                'contact' => $contact
                            ]
                        ),
                        'text/html'
                    );
            } catch (LoaderError $e) {
            } catch (RuntimeError $e) {
            } catch (SyntaxError $e) {
            }

            $this->mailer->send($message);

            $this->flashBag->add(
                'success',
                'Votre message a bien été envoyé.
                 Nous répondrons dans un délais de 48 heures.'
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
