<?php

namespace App\Tests\FunctionalTests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Trick;

/**
 * Class TrickControllerShowTest
 *
 * @package App\Tests\FunctionalTests
 */
class TrickControllerShowTest  extends WebTestCase
{
    use AuthentificationTrait;

    /**
     *
     */
    public function testShow()
    {
        $client = static::createAuthenticatedClient();

        $trick = $client->getContainer()->get('doctrine.orm.entity_manager')->getRepository(Trick::class)->findOneBy([]);

        $crawler = $client->request(Request::METHOD_GET, '/trick/' . $trick->getSlug());

        self::assertResponseStatusCodeSame(Response::HTTP_OK);

        $form = $crawler->filter('form[name=comment]')->form([
            'comment[content]' => 'content'
        ]);

        $client->submit($form);

        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }
}