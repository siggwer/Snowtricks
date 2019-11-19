<?php

namespace App\Controller;

use App\Entity\User;
use App\Handler\ResetHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ResetPasswordController.
 */
class ResetPasswordController extends AbstractController
{
    /**
     * @Route("/reset/{passwordToken}", name="reset_password", methods={"GET", "POST"})
     *
     * @param Request      $request
     * @param User         $user
     * @param ResetHandler $handler
     *
     * @return Response
     */
    public function resetPassword(Request $request, User $user, ResetHandler $handler): Response
    {
        if ($handler->handle($request, $user)) {
            return $this->redirectToRoute('security_login');
        }

        return $this->render(
            'security/reset/reset.html.twig',
            [
                'form' => $handler->createView(),
            ]
        );
    }
}
