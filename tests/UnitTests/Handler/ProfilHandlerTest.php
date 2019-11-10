<?php

namespace App\Tests\UnitTests\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;
use App\Handler\AbstractHandler;
use App\Handler\ProfilHandler;

/**
 * Class ProfilHandlerTest
 *
 * @package App\Tests\UnitTests\Handler
 */
class ProfilHandlerTest extends AbstractTestHandler
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
}