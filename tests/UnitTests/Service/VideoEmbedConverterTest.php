<?php

namespace App\Tests\UnitTests\Service;

use App\Services\VideoEmbedTrait;
use PHPUnit\Framework\TestCase;
use App\Entity\Video;

/**
 * Class VideoEmbedConverterTest
 *
 * @package App\Tests\UnitTests\Service
 */
class VideoEmbedConverterTest extends TestCase
{
    use VideoEmbedTrait;

    /**
     *
     */
    public function testYoutube()
    {
        $video = new video();
        $id = null;
        $trick = null;
        $url = 'https://www.youtube.com/watch?v=oI-umOzNBME';
        $video->setUrl($url);

        static::assertSame('https://www.youtube.com/embed/oI-umOzNBME', $this->converter($video));
    }

    /**
     *
     */
    public function testDaylimotion()
    {
        $video = new video();
        $id = null;
        $trick = null;
        $url = 'https://www.dailymotion.com/video/x6bq2cb';
        $video->setUrl($url);

        static::assertSame('https://www.dailymotion.com/embed/video/x6bq2cb', $this->converter($video));
    }

    /**
     *
     */
    public function testVimeo()
    {
        $video = new video();
        $id = null;
        $trick = null;
        $url = 'https://vimeo.com/85087990';
        $video->setUrl($url);

        static::assertSame('https://player.vimeo.com/video/85087990', $this->converter($video));
    }
}
