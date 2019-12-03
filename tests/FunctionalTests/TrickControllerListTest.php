<?php

namespace App\Tests\FunctionalTests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TrickControllerListTest
 *
 * @package App\Tests\FunctionalTests
 */
class TrickControllerListTest extends WebTestCase
{
    use AuthentificationTrait;

    public function testList()
    {
        $client = static::createClient();

        $client->request(Request::METHOD_GET, "/trick/list");

        self::assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}