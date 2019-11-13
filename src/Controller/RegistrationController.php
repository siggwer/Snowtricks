<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Handler\RegistrationHandler;
use App\Entity\User;
use Exception;

/**
 * Class RegistrationController.
 */
class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="security_register", methods={"GET","POST"})
     *
     * @param Request             $request
     * @param RegistrationHandler $handler
     *
     * @return Response
     *
     * @throws Exception
     */
    public function register(
        Request $request,
        RegistrationHandler $handler
    ): Response {
        if ($handler->handle($request, new User())) {
            return $this->redirectToRoute('home');
        }

        return $this->render(
            'security/register/register.html.twig',
            [
            'registrationForm' => $handler->createView(),
            ]
        );
    }
}
