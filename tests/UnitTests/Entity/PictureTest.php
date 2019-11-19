<?php

namespace App\Tests\UnitTests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Entity\Picture;
use Exception;

/**
 * Class PictureTest
 *
 * @package App\Tests\UnitTests\Entity
 */
class PictureTest extends TestCase
{
    /**
     *
     */
    public function setUp()
    {
        $picture = $this->createMock(Picture::class);
        $this->assertInstanceOf(Picture::class, $picture);
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

}