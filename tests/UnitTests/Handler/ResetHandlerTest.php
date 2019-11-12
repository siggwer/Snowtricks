<?php

namespace App\Tests\UnitTests\Handler;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Handler\AbstractHandler;
use App\Handler\ResetHandler;

/**
 * Class ResetHandlerTest
 *
 * @package App\Tests\UnitTests\Handler
 */
class ResetHandlerTest extends AbstractTestHandler
{
    /**
     * @return AbstractHandler
     */
    public function getHandler(): AbstractHandler
    {
        return new ResetHandler(
            $this->createMock(EntityManagerInterface::class),
            $this->createMock(FlashBagInterface::class)
        );
    }

    public function getData()
    {
        return new User();
    }
}