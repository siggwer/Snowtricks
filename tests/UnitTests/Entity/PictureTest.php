<?php

namespace App\Tests\UnitTests\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use PHPUnit\Framework\TestCase;
use App\Entity\Picture;
use App\Entity\Trick;
use Exception;

/**
 * Class PictureTest
 *
 * @package App\Tests\UnitTests\Entity
 */
class PictureTest extends TestCase
{
    /**
     * @var Picture
     */
    private $picture;

    /**
     * @var Trick
     */
    private $trick;

    /**
     *
     */
    public function setUp()
    {
        $this->picture = new Picture();
        $this->trick = new Trick();
    }

    /**
     *
     */
    public function testGetId()
    {
        $result = $this->picture->getId();
        $this->assertNotNull('1', $result);
    }

    /**
     *
     */
    public function testGetTrick()
    {
        $this->picture->setTrick($this->trick);
        $result = $this->picture->getTrick();
        $this->assertSame($this->trick, $result);
    }

    /**
     *
     */
    public function testGetTrickIsNull()
    {
        $this->picture->setTrick(null);
        $this->assertNull($this->picture->getTrick());
    }

    /**
     * @throws Exception
     */
    public function testGetPath()
    {
        $image = new Picture();
        $image->setPath('test.jpg');
        $result = $image->getPath();
        $this->assertSame('test.jpg', $result);
    }
    /**
     * @throws Exception
     */
    public function testGetPathIfIsNUll()
    {
        $image = new Picture();
        $image->setPath(null);
        $this->assertNull($image->getPath());
    }

    /**
     *
     */
    public function testGetAlt()
    {
        $image = new Picture();
        $image->setAlt('test');
        $result = $image->getAlt();
        $this->assertSame('test', $result);
    }

    /**
     *
     */
    public function testGetAltIsNull()
    {
        $image = new Picture();
        $image->setPath(null);
        $this->assertNull($image->getPath());
    }

    /**
     *
     */
    public function testGetUploadedFile()
    {
        $image = new Picture();
        $uploadedFile = new UploadedFile('public/images/image.png', '%kernel.project_dir%/public/uploads');
        $image->setUploadedFile($uploadedFile);
        $result = $image->getUploadedFile();
        $this->assertInstanceOf(UploadedFile::class, $result);
    }

    public function testGetUploadedFileIsNull()
    {
        $image = new Picture();
        $image->setUploadedFile(null);
        $this->assertNull($image->getUploadedFile());
    }

}