<?php

namespace App\Tests\UnitTests\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;
use App\Handler\UpdateTrickHandler;
use App\Handler\AbstractHandler;
use App\Entity\Trick;
use Exception;

/**
 * Class UpdateHandlerTest
 *
 * @package App\Tests\UnitTests\Handler
 */
class UpdateHandlerTest extends AbstractTestHandler
{
    /**
     * @return AbstractHandler
     */
    public function getHandler(): AbstractHandler
    {
        return new UpdateTrickHandler(
            $this->createMock(EntityManagerInterface::class),
            $this->createMock(EventDispatcherInterface::class),
            $this->createMock(FlashBagInterface::class),
            $this->createMock(Security::class)
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
            'name' => 'test',
            'description' => 'test',
            'alt' => 'test',
            'uploadedFile' => '\public\uploads\image.png'
        ];
    }
}