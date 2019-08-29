<?php

namespace App\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Trick
 *
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\TrickRepository")
 */
class Trick
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
     * @var string|null
     *
     * @Assert\NotBlank
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var DateTimeInterface|null
     *
     * @ORM\Column(type="datetime_immutable")
     */
    private $publishedAt;

    /**
     * @var DateTimeInterface|null
     *
     * @ORM\Column(type="datetime_immutable")
     */
    private $updatedAt;

    /**
     * @var User|null
     *
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $author;

    /**
     * @var string|null
     *
     * @Assert\NotBlank
     *
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var Category|null
     *
     * @Assert\NotNull
     *
     * @ORM\ManyToOne(targetEntity="Category")
     */
    private $category;

    /**
     * @var Collection|Comment[]
     *
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="trick")
     */
    private $comments;

    /**
     * @var Picture|null
     *
     * @Assert\Valid
     *
     * @ORM\OneToOne(targetEntity="Picture", cascade={"persist"})
     */
    /*a remettre apres
    @Assert\NotNull
     */
    private $pictureOnFront;

    /**
     * @var Collection|Picture[]
     *
     * @Assert\Valid
     *
     * @ORM\OneToMany(targetEntity="Picture", mappedBy="trick", cascade={"persist"}, orphanRemoval=false)
     */
    private $pictures;

    /**
     * @var Collection|Video[]
     *
     * @Assert\Valid
     *
     * @ORM\OneToMany(targetEntity="Video", mappedBy="trick", cascade={"persist"}, orphanRemoval=true)
     */
    private $videos;

    /**
     * Trick constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->publishedAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
        $this->comments = new ArrayCollection();
        $this->pictures = new ArrayCollection();
        $this->videos = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getPublishedAt(): ?DateTimeInterface
    {
        return $this->publishedAt;
    }

    /**
     * @param DateTimeInterface|null $publishedAt
     */
    public function setPublishedAt(?DateTimeInterface $publishedAt): void
    {
        $this->publishedAt = $publishedAt;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTimeInterface|null $updatedAt
     */
    public function setUpdatedAt(?DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return User|null
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * @param User|null $author
     */
    public function setAuthor(?User $author): void
    {
        $this->author = $author;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category|null $category
     */
    public function setCategory(?Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return Comment[]|Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param Comment[]|Collection $comments
     */
    public function setComments($comments): void
    {
        $this->comments = $comments;
    }

    /**
     * @return Picture|null
     */
    public function getPictureOnFront(): ?Picture
    {
        return $this->pictureOnFront;
    }

    /**
     * @param Picture|null $pictureOnFront
     */
    public function setPictureOnFront(?Picture $pictureOnFront): void
    {
        $this->pictureOnFront = $pictureOnFront;
    }

    /**
     * @return Picture[]|Collection
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * @param Picture $picture
     *
     * @return Trick
     */
    public function addPicture(Picture $picture): self //void
    {
        /*if (!$this->pictures->contains($picture)) {
            $picture->setTrick($this);
            $this->pictures->add($picture);
        }*/

        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setTrick($this);
        }
        return $this;
    }

    /**
     * @param Picture $picture
     *
     * @return Trick
     */
    public function removePicture(Picture $picture):  self //void
    {
        /*if ($this->pictures->contains($picture)) {
            $picture->setTrick(null);
            $this->pictures->removeElement($picture);
        }*/

        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
            if ($picture->getTrick() === $this) {
                $picture->setTrick(null);
            }
        }

        return $this;
    }

    /**
     * @return Video[]|Collection
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    /**
     * @param Video|null $video
     */
    public function setVideos(?Video $videos): void
    {
        $this->videos = $videos;
    }

    /**
     * @param Video $video
     *
     * @return Trick
     */
    public function addVideo(Video $video): self //void
    {
        /*if (!$this->videos->contains($video)) {
            $video->setTrick($this);
            $this->videos->add($video);
        }*/
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
            $video->setTrick($this);
        }
        return $this;
    }

    /**
     * @param Video $video
     *
     * @return Trick
     */
    public function removeVideo(Video $video): self //void
    {
        /*if ($this->videos->contains($video)) {
            $video->setTrick(null);
            $this->videos->removeElement($video);
        }*/

        if ($this->videos->contains($video)) {
            $this->videos->removeElement($video);
            if ($video->getTrick() === $this) {
                $video->setTrick(null);
            }
        }

        return $this;
    }
}
