<?php

namespace App\Tests\FunctionalTests;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;

class ProfilControllerTest extends WebTestCase
{
    use AuthentificationTrait;

    /**
     *
     */
    public function testProfil()
    {
        $client = static::createAuthenticatedClient();

        $crawler = $client->request(Request::METHOD_GET, '/mon-compte/profil');

        self::assertResponseStatusCodeSame(Response::HTTP_OK);

        $form = $crawler->filter('form[name=avatar]')->form([
            'avatar[avatar]' => [
                'uploadedFile' => $this->createFile()
            ],
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
            file_get_contents('http://via.placeholder.com/60x51')
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