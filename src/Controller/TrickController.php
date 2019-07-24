<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TrickController
 * @package App\Controller
 * @Route("/trick")
 */
class TrickController extends AbstractController
{
    /**
     * @Route("/list", name="trick_list")
     * @param TrickRepository $trickRepository
     * @param Request $request
     * @return Response
     */
    public function list(TrickRepository $trickRepository, Request $request): Response
    {
        return $this->render("trick/list.html.twig", [
            "tricks" => $trickRepository->findBy(
                [],
                ["publishedAt" => "desc"],
                6,
                ($request->query->get("page", 2) - 1) * 6
            )
        ]);
    }

    /**
     * @Route("/{id}", name="trick_show")
     * @param Trick $trick
     * @param CommentRepository $commentRepository
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function show(Trick $trick, CommentRepository $commentRepository, Request $request): Response
    {
        $totalComments = $commentRepository->count(["trick" => $trick]);

        $page = $request->query->get("page", 1);

        $comment = new Comment();
        $comment->setTrick($trick);

        // ATTENTION CETTE ETAPE SERA A SUPPRIME QUAND ON AURA FAIT LA CONNEXION
        $comment->setAuthor($this->getDoctrine()->getManager()->find(User::class, 1));

        $form = $this->createForm(CommentType::class, $comment)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($comment);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute("trick_show", ["id" => $trick->getId(), "_fragment" => "comments"]);
        }

        return $this->render("trick/show.html.twig", [
            "form" => $form->createView(),
            "trick" => $trick,
            "comments" => $commentRepository->findBy(
                ["trick" => $trick],
                ["publishedAt" => "desc"],
                10,
                ($page - 1) * 10
            ),
            "pagination" => [
                "page" => $page,
                "pages" => ceil($totalComments / 10),
                "range" => range(
                    max(1, $page - 3),
                    min(ceil($totalComments / 10), $page + 3)
                )
            ]
        ]);
    }
}
