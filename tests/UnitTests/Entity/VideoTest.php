<?php

namespace App\Tests\UnitTests\Entity;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use App\Entity\Trick;
use App\Entity\Video;
use ReflectionClass;
use Exception;

/**
 * Class VideoTest
 *
 * @package App\Tests\UnitTests\Entity
 */
class VideoTest extends TestCase
{
    /**
     * @var Trick
     */
    private $trick;

    /**
     * @var Video
     */
    private $video;

    /**
     *
     */
    public function setUp()
    {
        $this->trick = new Trick();
        $this->video = new Video();
    }

    /**
     *
     * @throws ReflectionException
     */
    public function testGetId()
    {
        $video = new Video();
        $this->assertNull($video->getId());
        $reflecion = new ReflectionClass($video);
        $property = $reflecion->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($video, '1');
        $this->assertEquals(1, $video->getId());
    }

    /**
     * @throws Exception
     */
    public function testGetUrl()
    {
        $video = new Video();
        $video->setUrl('video');
        $result = $video->getUrl();
        $this->assertSame('video', $result);
    }
    /**
     * @throws Exception
     */
    public function testGetUrlIfIfNull()
    {
        $video = new Video();
        $video->setUrl(null);
        $this->assertNull($video->getUrl());
    }

    /**
     *
     */
    public function testGetTrick()
    {
        $this->video->setTrick($this->trick);
        $result = $this->video->getTrick();
        $this->assertSame($this->trick, $result);
    }

    /**
     *
     */
    public function testGetTrickIsNull()
    {
        $this->video->setTrick(null);
        $this->assertNull($this->video->getTrick());
    }
}