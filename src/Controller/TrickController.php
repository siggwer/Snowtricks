<?php

namespace App\Controller;

use App\Handler\UpdateTrickHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Comment;
use App\Entity\Trick;
use App\Handler\AddTrickHandler;
use App\Handler\ShowTrickHandler;
use App\Repository\CommentRepository;
use App\Repository\TrickRepository;
use Exception;

/**
 * Class TrickController
 *
 * @package App\Controller
 *
 * @Route("/trick")
 */
class TrickController extends AbstractController
{
    /**
     * @Route("/list", name="trick_list", methods={"GET"})
     *
     * @param TrickRepository $trickRepository
     * @param Request         $request
     *
     * @return Response
     */
    public function list(
        TrickRepository $trickRepository,
        Request $request
    ): Response {
        return $this->render(
            'trick/list.html.twig',
            [
            'tricks' => $trickRepository->findBy(
                [],
                ['publishedAt' => "desc"],
                6,
                ($request->query->get('page', 2) - 1) * 6
            )
            ]
        );
    }

    /**
     * @Route("/add", name="trick_add", methods={"GET","POST"})
     *
     * @param Request         $request
     * @param AddTrickHandler $handler
     *
     * @return Response
     *
     * @throws Exception
     */
    public function add(Request $request, AddTrickHandler $handler): Response
    {
        $trick = new Trick();
        if ($handler->handle($request, $trick)) {

            return $this->redirectToRoute('trick_show', ['slug' => $trick->getSlug()]);
        }
        return $this->render(
            'trick/add.html.twig',
            [
            'form' => $handler->createView(),
            ]
        );
    }

    /**
     * @Route("/{slug}", name="trick_show", methods={"GET", "POST"})
     *
     * @param Trick             $trick
     * @param CommentRepository $commentRepository
     * @param Request           $request
     *
     * @return Response
     *
     * @throws Exception
     */
    public function show(Request $request,CommentRepository $commentRepository, Trick $trick, ShowTrickHandler $handler): Response
    {
        $totalComments = $commentRepository->count(['trick' => $trick]);

        $page = $request->query->get('page', 1);

        $comment = new Comment();
        $comment->setTrick($trick);

        if ($handler->handle($request, $comment)) {

            return $this->redirectToRoute('trick_show', ['slug' => $trick->getSlug(), '_fragment' => 'comments']);
        }

        return $this->render(
            'trick/show.html.twig',
            [
            'form' => $handler->createView(),
            'trick' =>$trick,
            'comments' => $commentRepository->findBy(
                ['trick' => $trick],
                ['publishedAt' => 'desc'],
                10,
                ($page - 1) * 10
            ),
            'pagination' => [
                'page' => $page,
                'pages' => ceil($totalComments / 10),
                'range' => range(
                    max(1, $page- 3),
                    min(ceil($totalComments / 10), $page + 3)
                )
            ]
            ]
        );
    }

    /**
     * @Route("/update/{slug}", name="trick_update", methods={"GET","POST"})
     *
     * @param Request $request
     * @param Trick $trick
     * @param UpdateTrickHandler $handler
     *
     * @return Response
     */
    public function update(
        Request $request,
        Trick $trick,
        UpdateTrickHandler $handler
    ): Response {

        if ($handler->handle($request, $trick)) {

            return $this->redirectToRoute('trick_show', ['slug' => $trick->getSlug()]);
        }

        return $this->render(
            "trick/update.html.twig",
            [
            'trick' => $trick,
            'form' => $handler->createView()

            ]
        );
    }

    /**
     * @Route("/{slug}", name="trick_delete", methods={"DELETE"})
     *
     * @param Trick   $trick
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function delete(
        Trick $trick,
        Request $request
    ): Response {
        if ($this->isCsrfTokenValid('delete'.$trick->getSlug(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($trick);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home');
    }
}
