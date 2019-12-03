<?php

namespace App\Tests\UnitTests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
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
     *
     */
    public function setUp()
    {
        $video = $this->createMock(Video::class);
        $this->assertInstanceOf(Video::class, $video);
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
}