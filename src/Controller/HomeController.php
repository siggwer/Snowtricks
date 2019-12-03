<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\TrickRepository;

/**
 * Class HomeController.
 *
 * @method getRequest()
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     *
     * @param TrickRepository $trickRepository
     *
     * @return Response
     */
    public function __invoke(
        TrickRepository $trickRepository
    ): Response {
        return $this->render(
            'home.html.twig',
            [
                'tricks' => $trickRepository->findBy([], ['publishedAt' => 'desc'], 6, 0),
            ]
        );
    }
}
