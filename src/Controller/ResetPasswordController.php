<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Handler\ResetHandler;
use App\Entity\User;

class ResetPasswordController extends AbstractController
{
    /**
     * @Route("/reset/{token}", name="reset_password", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param ResetHandler $handler
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function resetPassword(Request $request, ResetHandler $handler): Response
    {
        if($handler->handle($request)) {

            return $this->redirectToRoute('security_login');
        }
        return $this->render(
            'security/reset/reset.html.twig',
            [
                'form' => $handler->createView()
            ]
        );
    }
}