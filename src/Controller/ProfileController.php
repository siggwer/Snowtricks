<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Handler\ProfilHandler;

/**
 * Class ProfileController
 *
 * @package App\Controller
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/mon-compte/profil", name="mon-compte", methods={"GET","POST"})
     *
     * @param Request       $request
     * @param ProfilHandler $handler
     *
     * @return Response
     */
    public function EditProfile(
        Request $request,
        ProfilHandler $handler
    ): Response {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        if ($handler->handle($request, $this->getUser())) {
            return $this->redirectToRoute('mon-compte');
        }

        return $this->render(
            'user/profile.html.twig',
            [
            'user' => $this->getUser(),
            'avatar' => $this->getUser()->getAvatar(),
            'form' => $handler->createView(),
            ]
        );
    }
}
