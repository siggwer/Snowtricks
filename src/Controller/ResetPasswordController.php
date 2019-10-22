<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Handler\ResetHandler;
use App\Entity\User;
use Exception;

class ResetPasswordController extends AbstractController
{
    /**
     * @Route("/reset/{token}", name="reset_password", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param UserRepository $userRepository
     * @param ResetHandler $handler
     *
     * @return Response
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function resetPassword(Request $request,UserRepository $userRepository, ResetHandler $handler): Response
    {
        $token = $request->attributes->get('token');
        dd($token);
        if($user = $userRepository->checkResetToken($request->attributes->get('token'))){

            if($handler->handle($request, new User())) {

                return $this->redirectToRoute('security_login');
            }

        }
        return $this->render(
            'security/reset/reset.html.twig',
            [
                'form' => $handler->createView(),
            ]
        );
    }
}