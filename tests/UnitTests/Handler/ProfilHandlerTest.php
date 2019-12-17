<?php

namespace App\Tests\UnitTests\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Handler\AbstractHandler;
use App\Handler\ProfilHandler;
use App\Entity\Picture;
use App\Entity\User;

/**
 * Class ProfilHandlerTest
 *
 * @package App\Tests\UnitTests\Handler
 */
class ProfilHandlerTest extends AbstractHandlerTest
{
    /**
     * @return AbstractHandler
     */
    public function getHandler(): AbstractHandler
    {
        return new ProfilHandler(
            $this->createMock(EntityManagerInterface::class),
            $this->createMock(FlashBagInterface::class),
            $this->createMock(Security::class)
        );
    }

    /**
     * @return User|mixed
     *
     * @throws \Exception
     */
    public function getData()
    {
        return new User();
    }

    /**
     * @return array
     */
    public function getFormData(): array
    {
        return [
           'avatar' => [
               'picture' => [
                   'alt' => 'test',
                   'uploadedFile' => 'public/uploads/image.png'
               ]
           ]
        ];
    }

    /**
     * @param Request $request
     *
     * @return FormInterface
     */
    public function hydrate(Request $request): FormInterface
    {
        $picture = new Picture();
        $picture->setAlt($request->request->get("avatar")["picture"]["alt"]);
        $picture->setUploadedFile(
            new UploadedFile(
                $request->request->get("avatar")["picture"]["uploadedFile"],
                'image.png',
                'image/png',
                0,
                true
            )
        );

        $this->data->setAvatar($picture);
        return $this->form;
    }
}
