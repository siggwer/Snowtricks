<?php

namespace App\Controller;

use App\Entity\User;
use App\Handler\RegistrationHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Exception;

/**
 * Class RegistrationController
 *
 * @package App\Controller
 */
class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="security_register")
     *
     * @param Request             $request
     * @param RegistrationHandler $handler
     *
     * @return Response
     *
     * @throws Exception
     */
    public function register(Request $request, RegistrationHandler $handler): Response
    {
        if ($handler->handle($request, new User())) {

            return $this->redirectToRoute('mon-compte');
        }

        return $this->render(
            'security/register.html.twig',
            [
            'registrationForm' => $handler->createView(),
            ]
        );
    }
}
