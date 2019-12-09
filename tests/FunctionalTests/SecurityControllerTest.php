<?php

namespace App\Tests\FunctionalTests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SecurityControllerTest
 *
 * @package App\Tests\FunctionalTests
 */
class SecurityControllerTest extends WebTestCase
{
    /**
     *
     */
    public function testSecurity()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $form = $crawler->filter('form[name=login]')->form([
            'login[email]' => 'email+1@email.com',
            'login[password]' => 'password'
        ]);

        $client->submit($form);

        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);

        //form

        //redirection page d'acceuil $client->
    }
}