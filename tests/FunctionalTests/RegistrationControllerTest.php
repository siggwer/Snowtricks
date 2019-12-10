<?php

namespace App\Tests\FunctionalTests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RegistrationControllerTest
 *
 * @package App\Tests\FunctionalTests
 */
class RegistrationControllerTest extends WebTestCase
{
    /**
     *
     */
    public function testRegistration()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/register');

        $form = $crawler->filter('form[name=registration_form]')->form([
            'registration_form[username]' => 'test1',
            'registration_form[email]' => 'test1@yopmail.com',
            'registration_form[plainPassword]' => [
                'first' => 'password',
                'second' => 'password'
            ]
        ]);

        $client->submit($form);

        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }
}