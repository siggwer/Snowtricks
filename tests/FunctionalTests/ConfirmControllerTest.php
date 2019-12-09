<?php

namespace App\Tests\FunctionalTests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;

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
    public function testConform()
    {
        $client = static::createClient();

//        $user = $client->getContainer()->get('doctrine.orm.entity_manager')->getRepository(User::class)->findOneBy([]);
//
        $crawler = $client->request(Request::METHOD_GET, '/confirmregister/token-1');

        self::assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}