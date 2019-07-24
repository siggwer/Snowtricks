<?php

namespace App\Tests\FunctionalTests;

use App\Entity\Trick;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomepageTest
 * @package App\Tests\FunctionalTests
 */
class HomepageTest extends WebTestCase
{
    public function testHome()
    {
        $client = static::createClient();

        $client->request(Request::METHOD_GET, "/");

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testShow()
    {
        $client = static::createClient();

        $trick = $client->getContainer()->get("doctrine.orm.entity_manager")->getRepository(Trick::class)->findOneBy([]);

        $crawler = $client->request(Request::METHOD_GET, "/trick/" . $trick->getId());

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $form = $crawler->filter('form[name=comment]')->form([
            'comment[content]' => 'content'
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }

    public function testList()
    {
        $client = static::createClient();

        $client->request(Request::METHOD_GET, "/trick/list");

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
