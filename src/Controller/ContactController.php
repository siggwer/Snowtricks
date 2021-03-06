<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Handler\ContactHandler;
use App\Model\Contact;

/**
 * Class ContactController.
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     *
     * @param Request        $request
     * @param ContactHandler $handler
     *
     * @return Response
     */
    public function __invoke(
        Request $request,
        ContactHandler $handler
    ): Response {
        if ($handler->handle($request, new Contact())) {
            return $this->redirectToRoute('contact');
        }

        return $this->render(
            'contact/contact.html.twig',
            [
            'form' => $handler->createView(),
            ]
        );
    }
}
