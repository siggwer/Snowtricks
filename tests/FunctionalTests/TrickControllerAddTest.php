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

        $crawler = $client->request('GET', '/trick/add');

//        $form = $crawler->filter('form[name=trick]')->form([
//            'trick[name]' => 'name',
//            'trick[category]' => '1',
//            'trick[description]' => 'description',
//            'trick[pictureOnFront]' => [
//                'uploadedFile' => $this->createFile()
//            ],
//            $crawler->selectButton('Ajouter une image')->form(['trick[pictures]' => [
//                'uploadedFile' => $this->createFile()
//            ],]),
//            $crawler->selectButton('Ajouter une video')->form(['trick[videos]' => [
//                'url' => 'https://www.youtube.com/watch?v=oI-umOzNBME'
//            ],])
//            'trick[pictures]' => [
//                'uploadedFile' => $this->createFile()
//            ],
//            'trick[videos]' => [
//               'url' => 'https://www.youtube.com/watch?v=oI-umOzNBME'
//            ]

//        ]);

        $form = $crawler->filter('form[name=trick]')->form([]);

        $csrfToken = $form->get('trick')['_token']->getValue();

        //$client->submit($form);

        $formData = [
            'trick' => [
                '_token' => $csrfToken,
                'name' => 'yoyo',
                'category' => '1',
                'description]' => 'description]',
                'pictureOnFront' => [
                    'uploadedFile' => $this->createFile()
                ],
                'videos' => [
                    [
                        'url' => 'https://www.youtube.com/watch?v=oI-umOzNBME'
                    ]
                ]
            ]
        ];

        $fileData = [
            "trick" => [
                "pictures" => [
                    [
                        "uploadedFile" => $this->createFile()
                    ]
                ]
            ]
        ];

        $client->request(Request::METHOD_POST, "/trick/add", $formData, $fileData);

        $client->submit($form);

        $this->assertSame(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        //self::assertResponseStatusCodeSame(Response::HTTP_FOUND);
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