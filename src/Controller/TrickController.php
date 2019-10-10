<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\TrickType;
use App\Form\CommentType;
use App\Handler\AddTrickHandler;
use App\Repository\CommentRepository;
use App\Repository\TrickRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        if ($handler->handle($request, new Trick())) {
            return $this->redirectToRoute('trick_show', ['slug' => $handler->getSlug()]);
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
    public function show(
        Trick $trick,
        CommentRepository $commentRepository,
        Request $request
    ): Response {
        $totalComments = $commentRepository->count(['trick' => $trick]);

        $page = $request->query->get('page', 1);

        $comment = new Comment();
        $comment->setTrick($trick);

        $comment->setAuthor($this->getUser());

        $form = $this->createForm(CommentType::class, $comment)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($comment);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Le trick a bien été modifié.'
            );

            return $this->redirectToRoute('trick_show', ['slug' => $trick->getSlug(), '_fragment' => 'comments']);
        }

        return $this->render(
            'trick/show.html.twig',
            [
            'form' => $form->createView(),
            'trick' => $trick,
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
                    max(1, $page - 3),
                    min(ceil($totalComments / 10), $page + 3)
                )
            ]
            ]
        );
    }

    /**
     * @Route("/update/{slug}", name="trick_update", methods={"GET","POST"})
     *
     * @param Trick   $trick
     * @param Request $request
     *
     * @return Response
     */
    public function update(
        Trick $trick,
        Request $request
    ): Response {
        $form = $this->createForm(TrickType::class, $trick)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($trick);
            $this->getDoctrine()->getManager()->flush();

            //$this->addFlash('success', 'L\'article a été modifié avec succes');
            $this->get('session')->getFlashBag()->set('success', 'L\'article a été modifié avec succes');

            return $this->redirectToRoute('trick_show', ['slug' => $trick->getSlug()]);
        }

        return $this->render(
            "trick/update.html.twig",
            [
            'trick' => $trick,
            'form' => $form->createView()

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
