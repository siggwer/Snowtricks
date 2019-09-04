<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\TrickType;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\TrickRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @param Request $request
     *
     * @return Response
     */
    public function list(TrickRepository $trickRepository,
                         Request $request): Response
    {
        return $this->render('trick/list.html.twig', [
            'tricks' => $trickRepository->findBy(
                [],
                ['publishedAt' => "desc"],
                6,
                ($request->query->get('page', 2) - 1) * 6
            )
        ]);
    }

    /**
     * @Route("/add", name="trick_add", methods={"GET","POST"})
     *
     * @param Trick $trick
     * @param Request $request
     *
     * @return Response
     *
     * @throws Exception
     */
    public function add(Request $request): Response
    {
        $trick = new Trick();

        $form = $this->createForm(TrickType::class, $trick, [
            'validation_groups' => ['Default', "add"]
        ])
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->persist($trick);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('trick_show', ['id' => $trick->getId()]);
        }
        return $this->render('trick/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="trick_show", methods={"GET", "POST"})
     *
     * @param Trick $trick
     * @param CommentRepository $commentRepository
     * @param Request $request
     *
     * @return Response
     *
     * @throws Exception
     */
    public function show(Trick $trick,
                         CommentRepository $commentRepository,
                         Request $request): Response
    {
        $totalComments = $commentRepository->count(['trick' => $trick]);

        $page = $request->query->get('page', 1);

        $comment = new Comment();
        $comment->setTrick($trick);

        $comment->setAuthor($trick->getAuthor());

        $form = $this->createForm(CommentType::class, $comment)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($comment);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('trick_show', ["id" => $trick->getId(), '_fragment' => 'comments']);
        }

        return $this->render('trick/show.html.twig', [
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
        ]);
    }

    /**
     * @Route("/update/{id}", name="trick_update", methods={"GET","POST"})
     *
     * @param Trick $trick
     * @param Request $request
     *
     * @return Response
     */
    public function update(Trick $trick,
                           Request $request): Response
    {
        $form = $this->createForm(TrickType::class, $trick)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->persist($trick);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('trick_show', ['id' => $trick->getId()]);
        }

        return $this->render("trick/update.html.twig", [
            'trick' => $trick,
            'form' => $form->createView()

        ]);
    }

    /**
     * @Route("/{id}", name="trick_delete", methods={"DELETE"})
     *
     * @param Trick $trick
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function delete(Trick $trick,
                           Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trick->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($trick);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home');
    }
}
