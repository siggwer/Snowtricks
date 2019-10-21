<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Handler\ForgotHandler;
use App\Model\Forgot;

/**
 * Class ForgotController
 *
 * @package App\Controller
 */
class ForgotController extends AbstractController
{
    /**
     * @Route("/forgot", name="forgot", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param ForgotHandler $handler
     *
     * @return RedirectResponse|Response
     */
    public function forgotPassword(Request $request,ForgotHandler $handler)
    {
        if($handler->handle($request, new Forgot())) {

            return $this->redirectToRoute('home');
        }
        return $this->render(
            'security/forgot/forgot.html.twig',
            [
                'form' => $handler->createView()
            ]
        );
    }
}