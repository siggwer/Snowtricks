<?php

namespace App\Tests\FunctionalTests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ForgotControllerTest
 *
 * @package App\Tests\FunctionalTests
 */
class ForgotControllerTest extends WebTestCase
{
    /**
     *
     */
    public function testForgot()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/forgot');

        $form = $crawler->filter('form[name=forgot]')->form(
            [
            'forgot[email]' => 'email+1@email.com'
            ]
        );

        $client->submit($form);

        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }
}
