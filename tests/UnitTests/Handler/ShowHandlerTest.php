<?php

namespace App\Tests\UnitTests\Handler;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;
use App\Handler\ShowTrickHandler;
use App\Handler\AbstractHandler;
use App\Entity\Comment;
use Exception;

/**
 * Class ShowHandlerTest
 *
 * @package App\Tests\UnitTests\Handler
 */
class ShowHandlerTest extends AbstractTestHandler
{
    /**
     * @return AbstractHandler
     */
    public function getHandler(): AbstractHandler
    {
       return new ShowTrickHandler(
           $this->createMock(EntityManagerInterface::class),
           $this->createMock(FlashBagInterface::class),
           $this->createMock(Security::class)
       );
    }

    /**
     * @return Comment|mixed
     *
     * @throws Exception
     */
    public function getData()
    {
        return new Comment();
    }

    /**
     * @return array
     */
    public function getFormData(): array
    {
       return [
         'content' => 'test'
       ];
    }
}