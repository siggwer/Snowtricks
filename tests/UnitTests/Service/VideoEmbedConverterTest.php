<?php

namespace App\Tests\UnitTests\Service;

use App\Services\VideoEmbedConverter;
use PHPUnit\Framework\TestCase;
use App\Entity\Video;

/**
 * Class VideoEmbedConverterTest
 *
 * @package App\Tests\UnitTests\Service
 */
class VideoEmbedConverterTest extends TestCase
{
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
        $converter = new VideoEmbedConverter();
        static::assertSame('https://www.youtube.com/embed/oI-umOzNBME', $converter->converter($video));
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
        $converter = new VideoEmbedConverter();
        static::assertSame('https://www.dailymotion.com/embed/video/x6bq2cb', $converter->converter($video));
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
        $converter = new VideoEmbedConverter();
        static::assertSame('https://player.vimeo.com/video/85087990', $converter->converter($video));
    }
}