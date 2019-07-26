<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param TrickRepository $trickRepository
     * @return Response
     */
    public function __invoke(TrickRepository $trickRepository): Response
    {
        return $this->render("home.html.twig", [
            "tricks" => $trickRepository->findBy([], ["publishedAt" => "desc"], 6, 0)
        ]);
    }
}
