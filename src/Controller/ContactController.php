<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\ContactType;
use App\Model\Contact;

/**
 * Class ContactController
 *
 * @package App\Controller
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     *
     * @param FormFactoryInterface $formFactory
     * @param Request              $request
     * @param \Swift_Mailer        $mailer
     *
     * @return Response
     */
    public function __invoke(
        FormFactoryInterface $formFactory,
        Request $request,
        \Swift_Mailer $mailer
    ): Response {
        $contact = new Contact();

        $form = $formFactory->create(ContactType::class, $contact)->HandleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message = new \Swift_Message();

            $message
                ->setTo('admin.snowtrick@yopmail.com', 'Contact snowtricks')
                ->setFrom('admin.snowtrick@yopmail.com', 'Contact snowtricks')
                ->setReplyTo($contact->getEmail(), $contact->getName())
                ->setBody(
                    $this->renderView(
                        'contact/contact_email.html.twig',
                        [
                        'contact' => $contact
                        ]
                    ),
                    'text/html'
                );

            $mailer->send($message);

            $this->addFlash(
                'success',
                'Votre message a bien été envoyé.
                 Nous répondrons dans un délais de 48 heures.'
            );

            return $this->redirectToRoute('contact');
        }

        return $this->render(
            'contact/contact.html.twig',
            [
            'form' => $form->createView()
            ]
        );
    }
}
