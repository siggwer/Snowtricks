<?php

namespace App\Services;

use App\Entity\Video;

/**
 * Trait VideoEmbedTrait
 *
 * @package App\Services
 */
trait VideoEmbedTrait
{
    /**
     * @param Video $video
     * 
     * @return string|string[]|null
     */
    public function converter(Video $video)
    {
        if($video !== null) {
            $toConvert = $video->getUrl();

            if (preg_match('/(?:youtube\.com|youtu\.be)(?:\/watch\?v=|\/)(.+)/',
                    $toConvert, $match) == true)
            {
                $toConvert = preg_replace('/(?:youtube\.com|youtu\.be)(?:\/watch\?v=|\/)(.+)/',
                    'youtube.com/embed/' . $match[1], $toConvert);

            } elseif (preg_match('/(?:dailymotion\.com\/|dai\.ly)(?:video|hub)?\/([0-9a-z]+)/',
                    $toConvert, $match) == true)
            {
                $toConvert = preg_replace('/(?:dailymotion\.com\/|dai\.ly)(?:video|hub)?\/([0-9a-z]+)/',
                    'dailymotion.com/embed/video/' . $match[1], $toConvert);

            } elseif (preg_match('/(?:vimeo\.com\/)(?:channels\/[A-z]+\/)?([0-9]+)/',
                    $toConvert, $match) == true)
            {
                $toConvert = preg_replace('/(?:vimeo\.com\/)(?:channels\/[A-z]+\/)?([0-9]+)/',
                    'player.vimeo.com/video/' . $match[1], $toConvert);
            }
        }
        return $toConvert;
    }
}