<?php

namespace App\Tests\UnitTests\Entity;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use App\Entity\Comment;
use DateTimeImmutable;
use App\Entity\Trick;
use ReflectionClass;
use App\Entity\User;
use Exception;

/**
 * Class CommentTest
 *
 * @package App\Tests\UnitTests\Entity
 */
class CommentTest extends TestCase
{
    /**
     * @var Trick
     */
    private $trick;

    /**
     * @var Comment
     */
    private $comment;

    /**
     * @var User
     */
    private $user;

    /**
     *
     */
    public function setUp()
    {
        $this->comment = new Comment();
        $this->trick = new Trick();
        $this->user = new User();
    }

    /**
     *
     * @throws ReflectionException
     */
    public function testGetId()
    {
        $comment = new Comment();
        $this->assertNull($comment->getId());
        $reflecion = new ReflectionClass($comment);
        $property = $reflecion->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($comment, '1');
        $this->assertEquals(1, $comment->getId());
    }

    /**
     * @throws Exception
     */
    public function testGetMessageIfIsString()
    {
        $comment = new Comment();
        $comment->setContent('message test');
        $result = $comment->getContent();
        $this->assertSame('message test', $result);
    }

    /**
     * @throws Exception
     */
    public function testGetMessageIfIsNull()
    {
        $comment = new Comment();
        $comment->setContent(null);
        $this->assertNull($comment->getContent());
    }

    /**
     * @throws Exception
     */
    public function testGetPublishedAt()
    {
        $this->comment->setPublishedAt(new DateTimeImmutable());
        $result = $this->comment->getPublishedAt();
        $this->assertInstanceOf(DateTimeImmutable::class, $result);
    }

    /**
     * @throws Exception
     */
    public function testGetPublishedAtIfIsNull()
    {
        $this->comment->setPublishedAt(null);
        $this->assertNull($this->comment->getPublishedAt());
    }

    /**
     *
     */
    public function testGetAuthor()
    {
        $this->comment->setAuthor($this->user);
        $result = $this->comment->getAuthor();
        $this->assertSame($this->user, $result);
    }

    /**
     *
     */
    public function testGetAuthorIsNull()
    {
        $this->comment->setAuthor(null);
        $this->assertNull($this->comment->getAuthor());
    }

    /**
     *
     */
    public function testGetTrick()
    {
        $this->comment->setTrick($this->trick);
        $result = $this->comment->getTrick();
        $this->assertSame($this->trick, $result);
    }

    /**
     *
     */
    public function testGetTrickIsNull()
    {
        $this->comment->setTrick(null);
        $this->assertNull($this->comment->getTrick());
    }
}
