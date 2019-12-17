<?php

namespace App\Tests\UnitTests\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Handler\AbstractHandler;
use App\Handler\AddTrickHandler;
use App\Entity\Category;
use App\Entity\Picture;
use App\Entity\Trick;
use App\Entity\User;
use Exception;

/**
 * Class AddTrickHandlerTest
 *
 * @package App\Tests\UnitTests\Handler
 */
class AddTrickHandlerTest extends AbstractHandlerTest
{
    /**
     * @return AbstractHandler
     */
    public function getHandler(): AbstractHandler
    {
        $user = $this->createMock(User::class);
        $user->method('getEmail')->willReturn('email@email.com');

        $security = $this->createMock(Security::class);
        $security->method('getUser')->willReturn($user);

        return new AddTrickHandler(
            $this->createMock(EntityManagerInterface::class),
            $this->createMock(EventDispatcherInterface::class),
            $this->createMock(FlashBagInterface::class),
            $security
        );
    }

    /**
     * @return Trick|mixed
     *
     * @throws Exception
     */
    public function getData()
    {
        return new Trick();
    }

    /**
     * @return array
     */
    public function getFormData(): array
    {
        return [
            'trick' => [
                'name' => 'test',
                'description' => 'test',
                'category' => 1,
                'pictureOnFront' => [
                    'alt' => 'test',
                    'uploadedFile' => 'public/uploads/image.png'
                ],
                'slug' => '-test',
                'email' => 'test@yopmail.com',

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
        $this->data->setSlug("slug");
        $this->data->setName($request->request->get("trick")["name"]);
        $this->data->setCategory(new Category());
        $this->data->setDescription($request->request->get("trick")["description"]);

        $picture = new Picture();
        $picture->setAlt($request->request->get("trick")["pictureOnFront"]["alt"]);
        $picture->setUploadedFile(
            new UploadedFile(
                $request->request->get("trick")["pictureOnFront"]["uploadedFile"],
                'image.png',
                'image/png',
                0,
                true
            )
        );

        $this->data->setPictureOnFront($picture);

        return $this->form;
    }
}
