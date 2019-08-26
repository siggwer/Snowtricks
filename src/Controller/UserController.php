<?php

namespace App\Controller;


use App\Repository\TrickRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Trick;

/**
 * Class UserController
 *
 * @package App\Controller
 */
class UserController extends AbstractController
{
    /**
     * @Route("/user_profile", name="user_profile", methods={"GET", "POST"} )
     *
     * @param Trick $trick
     * @param UserInterface $user
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(TrickRepository $trickRepository, UserRepository $user, Request $request) : Response
    {
        return $this->render("user/user_profile.html.twig", [
            "tricks" => $trickRepository->findBy(
                [],
                ["publishedAt" => "desc"],
                6,
                ($request->query->get("page", 2) - 1) * 6
            )
        ]);
    }
}