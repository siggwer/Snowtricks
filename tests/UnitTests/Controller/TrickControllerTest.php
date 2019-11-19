<?php

namespace App\Tests\UnitTests\Controller;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\TrickRepository;
use Exception;

/**
 * Class TrickControllerTest
 *
 * @package App\Tests\UnitTests\Controller
 */
class TrickControllerTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testList()
    {
        $request = $this->createMock(Request::class);
        $request->request = new ParameterBag();

        $trick = $this->createMock(TrickRepository::class);
        $trick->method('findBy')->willReturn(true);

        $this->assertTrue(Request::class);
    }
}