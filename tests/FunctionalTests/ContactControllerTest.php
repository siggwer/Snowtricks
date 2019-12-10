<?php

namespace App\Tests\FunctionalTests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ContactControllerTest
 *
 * @package App\Tests\FunctionalTests
 */
class ContactControllerTest extends WebTestCase
{
    /**
     *
     */
    public function testContact()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/contact');

        $form = $crawler->filter('form[name=contact]')->form([
            'contact[name]' => 'name',
            'contact[email]' => 'test@yopmail.com',
            'contact[subject]' => 'test',
            'contact[message]' => 'test'
        ]);

        $client->submit($form);

        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }
}