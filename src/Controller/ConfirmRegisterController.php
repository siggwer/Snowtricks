<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/confirmregister/{token}", name="confirm_register")
     *
     * @param  Request        $request
     * @param  UserRepository $userRepository
     * @return RedirectResponse|Response
     */
    public function confirmRegister(
        Request $request,
        User $user,
        FlashBagInterface $flashBag,
        UserRepository $userRepository
    ) {
        $user->setToken(null);

        $userRepository->save($user);

        $flashBag->add('success', 'Votre compte à bien été créé');

        return new RedirectResponse(
            $this->generateUrl('security_login'),
            RedirectResponse::HTTP_FOUND
        );
    }
}
