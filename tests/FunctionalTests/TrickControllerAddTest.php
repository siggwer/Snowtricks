<?php

namespace App\Tests\FunctionalTests;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TrickControllerAddTest
 *
 * @package App\Tests\FunctionalTests
 */
class TrickControllerAddTest extends WebTestCase
{
    use AuthentificationTrait;

    /**
     *
     */
    public function testAdd()
    {
        $client = static::createAuthenticatedClient();

        $crawler = $client->request(Request::METHOD_GET, '/trick/add');

        $form = $crawler->filter('form[name=trick]')->form([]);

        $csrfToken = $form->get('trick')['_token']->getValue();

        $formData = [
            'trick' => [
                '_token' => $csrfToken,
                'name' => 'test',
                'category' => '1',
                'description' => 'description',
                'pictureOnFront' => [
                    'alt' => 'alt',
                    'uploadedFile' => $this->createFile()
                ],
                'videos' => [
                    [
                        'url' => 'https://www.youtube.com/watch?v=oI-umOzNBME'
                    ]
                ]
            ]
        ];

        $client->request(Request::METHOD_POST, '/trick/add', $formData);

        $this->assertSame(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }

    /**
     * @return UploadedFile
     */
    private function createFile(): UploadedFile
    {
        $filename = md5(uniqid('', true)).'.png';
        file_put_contents(
            __DIR__.'/../../public/uploads/' . $filename,
            file_get_contents('http://via.placeholder.com/400x400')
        );
        return new UploadedFile(
            __DIR__.'/../../public/uploads/' . $filename,
            $filename,
            'image/png',
            null,
            true
        );
    }
}
