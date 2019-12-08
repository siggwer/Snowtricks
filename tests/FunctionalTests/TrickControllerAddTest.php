<?php

namespace App\Tests\FunctionalTests;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TrickControllerAddTest
 *
 * @package App\Tests\FunctionalTests
 */
class TrickControllerAddTest  extends WebTestCase
{
    use AuthentificationTrait;

    /**
     *
     */
    public function testShow()
    {
        $client = static::createAuthenticatedClient();

        $crawler = $client->request('GET', '/trick/add');

        $form = $crawler->filter('form[name=trick]')->form([
            'trick[name]' => 'name',
            'trick[category]' => '1',
            'trick[description]' => 'description',
            'trick[pictureOnFront]' => [
                "uploadedFile" => $this->createFile()
            ],
            'trick[pictures]' => [
                "uploadedFile" => $this->createFile()
            ]

//            'trick[videos]' => 'https://www.youtube.com/watch?v=oI-umOzNBME'

        ]);

        $client->submit($form);

        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);
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