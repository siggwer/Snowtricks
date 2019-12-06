<?php

namespace App\Tests\UnitTests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Trick;
use App\Entity\Video;
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
     */
    public function testGetId()
    {
        $result = $this->video->getId();
        $this->assertNotNull('1', $result);
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