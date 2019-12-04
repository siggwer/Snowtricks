<?php

namespace App\Tests\UnitTests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Category;
use App\Entity\Picture;
use App\Entity\Comment;
use DateTimeImmutable;
use App\Entity\Trick;
use App\Entity\Video;
use App\Entity\User;
use Exception;

/**
 * Class TrickTest
 *
 * @package App\Tests\UnitTests\Entity
 */
class TrickTest extends TestCase
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Trick
     */
    private $trick;

    /**
     * @var Comment
     */
    private $comment;

    /**
     * @var Picture
     */
    private $picture;

    /**
     * @throws Exception
     */
    public function setUp()
    {
        $this->user = new User();
        $this->trick = new Trick();
        $this->comment = new Comment();
        $this->picture = new Picture();

    }

    /**
     * @throws Exception
     */
    public function testGetName()
    {
        $this->trick->setName('test');
        $result = $this->trick->getName();
        $this->assertSame('test', $result);
    }

    /**
     * @throws Exception
     */
    public function testGetNameIfIsNull()
    {
        $this->trick->setName(null);
        $this->assertNull($this->trick->getName());
    }

    /**
     * @throws Exception
     */
    public function testGetDescription()
    {
        $this->trick->setDescription('test');
        $result = $this->trick->getDescription();
        $this->assertSame('test', $result);
    }

    /**
     * @throws Exception
     */
    public function testGetDescriptionIfIsNull()
    {
        $this->trick->setDescription(null);
        $this->assertNull($this->trick->getDescription());
    }

    /**
     * @throws Exception
     */
    public function testGetComment()
    {
        $this->trick->setComments('test');
        $result = $this->trick->getComments();
        $this->assertSame('test', $result);
    }

    /**
     * @throws Exception
     */
    public function testGetCommentIfIsNull()
    {
        $this->trick->setComments(null);
        $this->assertNull($this->trick->getComments());
    }

    /**
     * @throws Exception
     */
    public function testGetCategory()
    {
        $category = new Category();
        $this->trick->setCategory($category);
        $result = $this->trick->getCategory();
        $this->assertEquals($category, $result);
    }

    /**
     * @throws Exception
     */
    public function testGetCategoryIfIsNull()
    {
        $this->trick->setCategory(null);
        $this->assertNull($this->trick->getCategory());
    }

    /**
 * @throws Exception
 */
    public function testGetPictureOnFront()
    {
        $picture = new Picture();
        $this->trick->setPictureOnFront($picture);
        $result = $this->trick->getPictureOnFront();
        $this->assertEquals($picture, $result);
    }

    /**
     * @throws Exception
     */
    public function testGetPictureOnFrontIfIsNull()
    {
        $this->trick->setPictureOnFront(null);
        $this->assertNull($this->trick->getPictureOnFront());
    }

    /**
     * @throws Exception
     */
    public function testGetPicture()
    {
        $picture = new Picture();
        $this->trick->addPicture($picture);
        $this->assertSame($picture, $this->trick->getPictures()->first());
        $this->assertCount(1, $this->trick->getPictures());
    }

    public function testRemovePicture()
    {
        $picture = new Picture();
        $picture->setTrick($this->trick);
        $this->trick->removePicture($picture);
        $this->assertSame($picture, $this->trick->removePicture($this->picture));
    }

    /**
     * @throws Exception
     */
    public function testGetVideo()
    {
        $video = new Video();
        $this->trick->addVideo($video);
        $this->assertSame($video, $this->trick->getVideos()->first());
        $this->assertCount(1, $this->trick->getVideos());
    }


    /**
     * @throws Exception
     */
    public function testGetPublishedAt()
    {
        $this->trick->setPublishedAt(new DateTimeImmutable());
        $result = $this->trick->getPublishedAt();
        $this->assertInstanceOf(DateTimeImmutable::class, $result);
    }

    /**
     * @throws Exception
     */
    public function testGetPublishedAtIfIsNull()
    {
        $this->trick->setPublishedAt(null);
        $this->assertNull($this->trick->getPublishedAt());
    }

    /**
     * @throws Exception
     */
    public function testGetUpdatedAt()
    {
        $this->trick->setUpdatedAt(new DateTimeImmutable());
        $result = $this->trick->getUpdatedAt();
        $this->assertInstanceOf(DateTimeImmutable::class, $result);
    }

    /**
     * @throws Exception
     */
    public function testGetUpdatedAtIfIsNull()
    {
        $this->trick->setUpdatedAt(null);
        $this->assertNull($this->trick->getUpdatedAt());
    }

    /**
     *
     */
    public function testGetAuthor()
    {
        $this->trick->setAuthor($this->user);
        $result = $this->trick->getAuthor();
        $this->assertSame($this->user, $result);
    }

    /**
     *
     */
    public function testGetAuthorIsNull()
    {
        $this->trick->setAuthor(null);
        $this->assertNull($this->trick->getAuthor());
    }

    /**
     *
     */
    public function testGetSlug()
    {
        $this->assertNull($this->trick->getSlug());
        $this->trick->setSlug('test-trick');
        $result = $this->trick->getSlug();
        $this->assertSame('test-trick', $result);
    }
}