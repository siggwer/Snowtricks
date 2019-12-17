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

        $form = $crawler->filter('form')->form(
            [
            'email' => 'email+1@email.com',
            'password' => 'password'
            ]
        );

        $client->submit($form);

        $this->assertEquals('security_login', $client->getRequest()->attributes->get('_route'));

        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }
}
