<?php

namespace App\Controller;

use App\Handler\ForgotHandler;
use App\Model\Forgot;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ForgotController
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
     * @return Response
     */
    public function forgot(Request $request, ForgotHandler $handler): Response
    {
        if($handler->handle($request, new Forgot())) {
            return $this->redirectToRoute('forgot');
        }
        return $this->render(
            'security/forgot/_form_forgot.html.twig',
            [
                'form' => $handler->createView()
            ]
        );
    }
}