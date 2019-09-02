<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 *
 * @package App\Controller
 * @method getRequest()
 */
class HomeController extends AbstractController
{
    /**
     * @var
     */
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/", name="home")
     *
     * @param EntityManagerInterface $em
     * @param TrickRepository $trickRepository
     *
     * @return Response
     */
    public function __invoke(EntityManagerInterface $em, TrickRepository $trickRepository): Response
    {
        $currentAvatar = $em->getRepository(User::class)->findBy(array('avatar'));

        dd($currentAvatar);
        return $this->render("home.html.twig", [
            "tricks" => $trickRepository->findBy([], ["publishedAt" => "desc"], 6, 0),
        ]);
    }
}
