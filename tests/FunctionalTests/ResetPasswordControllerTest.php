<?php

namespace App\Tests\FunctionalTests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordControllerTest extends WebTestCase
{
    public function testReset()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/register');

        $form = $crawler->filter('form[name=reset_form]')->form([
            'reset_form[plainPassword]' => [
                'first' => 'password',
                'second' => 'password'
            ]
        ]);

        $client->submit($form);

        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }
}