<?php

namespace App\Tests\FunctionalTests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Trick;

/**
 * Class TrickControllerAddTest
 * @package App\Tests\FunctionalTests
 */
class TrickControllerAddTest  extends WebTestCase
{
    use AuthentificationTrait;

    /**
     *
     */
    public function testShow()
    {
        $client = static::createAuthenticatedClient();

        $crawler = $client->request('GET', '/trick/add');

        $form = $crawler->filter('form[name=trick]')->form([
            'trick[name]' => 'name',
            'trick[category]' => '1',
            'trick[description]' => 'description',
//            'trick[pictureOnFront]' => 'public/images/image.png',
//            'trick[pictures]' => 'public/images/image.png',
//            'trick[videos]' => 'https://www.youtube.com/watch?v=oI-umOzNBME'

        ]);

        $client->submit($form);

        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }
}