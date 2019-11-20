<?php

namespace App\Entity;

use Embera\Embera;
use Essence\Essence;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Video.
 *
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 */
class Video
{
    /**
     * @var int|null
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Trick|null
     *
     * @ORM\ManyToOne(targetEntity="Trick", inversedBy="videos")
     * @ORM\JoinColumn(name="video_id",     referencedColumnName="id", onDelete="CASCADE") //ajout JoinColumn pour la supression
     */
    private $trick;

    /**
     * @var string|null
     *
     * @Assert\NotBlank
     * @Assert\Url
     *
     * @ORM\Column(type="string")
     */
    private $url;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Trick|null
     */
    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    /**
     * @param Trick|null $trick
     */
    public function setTrick(?Trick $trick): void
    {
        $this->trick = $trick;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     */
    public function setUrl(?string $url): void
    {
        dd($url);
        $embera = new Embera();
        $embera->autoEmbed($url);
        $url = $embera->getUrlInfo($url);
        $Essence = new Essence();
        $media = $Essence->extractAll($url);
        dd($media,$url);
        $this->url = $url;
    }
}
