<?php

namespace App\Tests\FunctionalTests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ConfirmControllerTest
 *
 * @package App\Tests\FunctionalTests
 */
class ConfirmControllerTest extends WebTestCase
{
    /**
     *
     */
    public function testConfirm()
    {
        $client = static::createClient();

        $crawler = $client->request(Request::METHOD_GET, '/confirmregister/token-1');

        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }
}