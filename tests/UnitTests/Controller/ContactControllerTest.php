<?php

namespace App\Tests\UnitTests\Controller;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\HttpFoundation\Request;
use App\Handler\ContactHandler;

/**
 * Class ContactControllerTest
 *
 * @package App\Tests\UnitTests\Controller
 */
class ContactControllerTest extends TestCase
{
    /**
     *
     */
    public function testInvoke()
    {
        $request = $this->createMock(Request::class);
        $contact = $this->createMock(ContactHandler::class);
    }
}