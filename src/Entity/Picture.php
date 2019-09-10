<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Picture
 *
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\PictureRepository")
 * @ORM\EntityListeners({"App\EntityListener\PictureListener"})
 */
class Picture
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
     * @ORM\ManyToOne(targetEntity="Trick", inversedBy="pictures")
     * @ORM\JoinColumn(name="picture_id", referencedColumnName="id", onDelete="CASCADE") //ajout JoinColumn pour la supression
     */
    private $trick;

    /**
     * @var string|null
     *
     * @Assert\NotBlank
     *
     * @ORM\Column(type="string")
     */
    private $alt;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    private $path;

    /**
     * @var UploadedFile|null
     *
     * @Assert\Image
     * @Assert\NotNull(groups={"add"})
     */
    private $uploadedFile;

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
    public function getAlt(): ?string
    {
        return $this->alt;
    }

    /**
     * @param string|null $alt
     */
    public function setAlt(?string $alt): void
    {
        $this->alt = $alt;
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param string|null $path
     */
    public function setPath(?string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return UploadedFile|null
     */
    public function getUploadedFile(): ?UploadedFile
    {
        return $this->uploadedFile;
    }

    /**
     * @param UploadedFile|null $uploadedFile
     */
    public function setUploadedFile(?UploadedFile $uploadedFile): void
    {
        $this->uploadedFile = $uploadedFile;
    }
}
