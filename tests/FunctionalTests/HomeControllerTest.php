<?php

namespace App\Tests\FunctionalTests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HomeControllerTest
 *
 * @package App\Tests\FunctionalTests
 */
class HomeControllerTest extends WebTestCase
{
    //use AuthentificationTrait;

    /**
     *
     */
    public function testHome()
    {
        $client = static::createClient();

        $client->request(Request::METHOD_GET, '/');

        self::assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}