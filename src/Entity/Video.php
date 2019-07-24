<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Video
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 */
class Video
{
    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Trick|null
     * @ORM\ManyToOne(targetEntity="Trick", inversedBy="videos")
     */
    private $trick;

    /**
     * @var string|null
     * @Assert\NotBlank
     * @Assert\Url
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
        $this->url = $url;
    }
}