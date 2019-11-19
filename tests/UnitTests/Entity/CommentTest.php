<?php

namespace App\Tests\UnitTests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Entity\Comment;
use Exception;

/**
 * Class CommentTest
 *
 * @package App\Tests\UnitTests\Entity
 */
class CommentTest extends TestCase
{
    /**
     *
     */
    public function setUp()
    {
        $comment = $this->createMock(Comment::class);
        $this->assertInstanceOf(Comment::class, $comment);
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
}