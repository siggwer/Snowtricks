<?php

namespace App\Controller;

use App\Entity\User;
use App\Event\AvatarEvent;
use App\Listener\AfterLoginListener;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * Class HomeController
 *
 * @package App\Controller
 * @method getRequest()
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     *
     * @param TrickRepository $trickRepository
     * @param Security $security
     * @return Response
     */
    public function __invoke(TrickRepository $trickRepository): Response
    {
        return $this->render("home.html.twig", [
                "tricks" => $trickRepository->findBy([], ["publishedAt" => "desc"], 6, 0),
            ]);

    }
}
