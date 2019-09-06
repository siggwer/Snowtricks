<?php

namespace App\Controller;

use App\Form\AvatarType;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserProfileController
 *
 * @package App\Controller
 */
class UserProfileController extends AbstractController
{
    /**
     * @Route("/mon-compte/profil", name="mon-compte", methods={"GET","POST"})
     *
     * @param Request $request
     * @param string $uploadDir
     *
     * @return Response
     */
    public function EditProfile(Request $request,
                                ObjectManager $manager,
                                UserRepository $user,
                                string $uploadDir): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $this->getUser();
        $currentAvatar = $user->getAvatar();

        $form = $this->createForm(AvatarType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filename = md5(uniqid("", true)). "." . $user
                    ->getPictureOnFront()
                    ->getUploadedFile()
                    ->getClientOriginalExtension();

            $user->getPictureOnFront()
                ->getUploadedFile()
                ->move($uploadDir, $filename);

            $user->getPictureOnFront()
                ->setPath("uploads/".$filename);

            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mon-compte');
        }

        return $this->render('user/profile.html.twig', [
            'user'=> $user,
            'avatar'=> $currentAvatar,
            'form'=> $form->createView()
        ]);

    }
}