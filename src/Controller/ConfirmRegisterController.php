<?php

namespace App\Controller;

use http\Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\NonUniqueResultException;
use App\Repository\UserRepository;

/**
 * Class ConfirmRegisterController
 *
 * @package App\Controller
 */
class ConfirmRegisterController extends AbstractController
{
    /**
     * @Route("/register", name="security_register")
     *
     * @param Request $request
     * @param UrlGeneratorInterface $urlGenerator
     * @param UserRepository $userRepository
     * @return RedirectResponse|Response
     */
    public function confirmRegister(
        Request $request,
        UrlGeneratorInterface $urlGenerator,
        FlashBagInterface $flashBag,
        UserRepository $userRepository
    ){
        try {
            $user = $userRepository->checkRegistrationToken($request->get('token'));
        } catch (NonUniqueResultException $e) {
        }

        if ($user !== null) {

           $confirmRegistration = $userRepository->save($user);
           $flashBag->add('success', 'Votre compte à bien été créer');
            return new RedirectResponse($this->generateUrl('login'),
                RedirectResponse::HTTP_FOUND);
        }
        return new Response($this->render('home.html.twig'),
            Response::HTTP_OK);
    }
}