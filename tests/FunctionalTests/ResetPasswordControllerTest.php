<?php

namespace App\Tests\FunctionalTests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ResetPasswordControllerTest
 *
 * @package App\Tests\FunctionalTests
 */
class ResetPasswordControllerTest extends WebTestCase
{
    /**
     *
     */
    public function testReset()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/reset/token-1');

        $form = $crawler->filter('form[name=reset]')->form([
            'reset[plainPassword]' => [
                'first' => 'password',
                'second' => 'password'
            ]
        ]);

        $client->submit($form);

        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }
}