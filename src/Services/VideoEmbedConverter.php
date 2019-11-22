<?php

namespace App\Services;

use Embera\Embera;

/**
 * Class VideoEmbedConverter
 *
 * @package App\Services
 */
class VideoEmbedConverter
{
//    /**
//     * @var string
//     */
//    private $embra;
//
//    /**
//     * VideoEmbedConverter constructor.
//     *
//     * @param string $embra
//     */
//    public function __construct(
//        string $embra
//    ){
//        $this->embra = $embra;
//    }

    /**
     * @param string $embra
     *
     * @return Embera
     */
    public function converter(string $embra)
    {
//        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $embra, $matches);
////        dd(preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $embra, $matches));
//        $config = array(
//            'allow' => array('Youtube', 'Vimeo', 'Daylymotion'),
//            'ignore_tags' => array('a', 'img', 'strong', 'iframe', 'width', 'heigh', 'html', 'frameborder ','allow', 'autoplay')
//        );
//        $convert = new Essence();
//        $url = $convert->crawlUrl($embra);
//        $embera = new Embera($config);
//        $media = $embera->autoEmbed($embra);
//        $preUrl = array($media);
//        $convert = new Essence();
//        $url = $convert->extract($preUrl);
//        preg_match('/(?:youtube\.com|youtu\.be)(?:\/watch\?v=|\/)(.+)/');
//        preg_match('/(?:vimeo\.com\/)(?:channels\/[A-z]+\/)?([0-9]+)/');
//        preg_match('/(?:dailymotion\.com\/|dai\.ly)(?:video|hub)?\/([0-9a-z]+)/');

        if(!empty($embra))
            {
//                $url = str_replace(
//                    'www.youtube.com/watch?v=',
//                    'www.youtube.com/embed/', $embra);
            $sid = preg_match('/(?:youtube\.com|youtu\.be)(?:\/watch\?v=|\/)(.+)/',
                $embra, $match);

//            $sid = preg_match('/(?:youtube\.com|youtu\.be)(?:\/watch\?v=|\/)(.+)/',
//                'www.youtube.com/embed/', $match, $embra);
//
            $sid1 = preg_replace('/(?:youtube\.com|youtu\.be)(?:\/watch\?v=|\/)(.+)/',
            'youtube.com/embed/'.$match[1],$embra);


            dd($sid, $match, $sid1);

//            $youtube = preg_replace(
//                '/(?:youtube\.com|youtu\.be)(?:\/watch\?v=|\/)(.+)/',
//                'www.youtube.com/embed/',
//            );
//           dd($youtube);
            
            }



        //dd($embra, $youtube);
        //return $url;
    }

}