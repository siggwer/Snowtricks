<?php

namespace App\Controller;

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
     *
     * @return Response
     */
    public function forgot(Request $request): Response
    {
        return $this->render(':security/forgot:_form_forgot.html.twig');
    }
}