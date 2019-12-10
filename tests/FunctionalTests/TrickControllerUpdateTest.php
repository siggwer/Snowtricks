<?php

namespace App\Tests\FunctionalTests;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Trick;

/**
 * Class TrickControllerAddTest
 * @package App\Tests\FunctionalTests
 */
class TrickControllerUpdateTest  extends WebTestCase
{
    use AuthentificationTrait;

    /**
     *
     */
    public function testShow()
    {
        $client = static::createAuthenticatedClient();

        $trick = $client->getContainer()->get('doctrine.orm.entity_manager')->getRepository(Trick::class)->findOneBy([]);

        $crawler = $client->request(Request::METHOD_GET, '/trick/update/' . $trick->getSlug());

        self::assertResponseStatusCodeSame(Response::HTTP_OK);

        $form = $crawler->filter('form[name=update_trick]')->form([]);

        $csrfToken = $form->get('update_trick')['_token']->getValue();

        $formData = [
            'update_trick' => [
                '_token' => $csrfToken,
                'name' => 'name',
                'category' => '1',
                'description]' => 'description]',
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

        $fileData = [
            'update_trick' => [
                'pictures' => [
                    [
                        'alt' => 'alt',
                        'uploadedFile' => $this->createFile()
                    ]
                ]
            ]
        ];

        $client->request(Request::METHOD_POST, '/trick/ '. $trick->getSlug(), $formData, $fileData);

        $client->submit($form);

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