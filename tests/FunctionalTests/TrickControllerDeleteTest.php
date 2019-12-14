<?php

namespace App\Tests\FunctionalTests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Trick;

/**
 * Class TrickControllerDeleteTest
 *
 * @package App\Tests\FunctionalTests
 */
class TrickControllerDeleteTest extends WebTestCase
{
    use AuthentificationTrait;

    /**
     *
     */
    public function testDelete()
    {
        $client = static::createAuthenticatedClient();

        $trick = $client->getContainer()->get('doctrine.orm.entity_manager')->getRepository(Trick::class)->findOneBy([]);

        $client->request(Request::METHOD_DELETE, '/trick/delete/' . $trick->getSlug());

        $this->assertSame(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}