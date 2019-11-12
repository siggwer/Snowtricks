<?php

namespace App\Tests\UnitTests\Entity;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Entity\Trick;
use Exception;
use DateTime;

/**
 * Class TrickTest
 *
 * @package App\Tests\UnitTests\Entity
 */
class TrickTest extends TestCase
{
    /**
     * @var Trick
     */
    private $trick;

    /**
     * @var User
     */
    private $user;

    /**
     * @throws Exception
     */
    public function setUp()
    {
        $this->trick = new Trick();
        $this->user = new User();
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
    public function testGetPublishedAt()
    {
        $this->trick->setPublishedAt(new DateTime('20/11/2019'));
        $result = $this->trick->getPublishedAt();
        $this->assertSame(new DateTime('20/11/2019'), $result);
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
        $this->trick->setUpdatedAt(new DateTime('20/11/2019'));
        $result = $this->trick->getUpdatedAt();
        $this->assertSame(new DateTime('20/11/2019'), $result);
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
        $this->trick->setAuthor($this->trick->getName('trick'));
        $result = $this->trick->getAuthor();
        $this->assertSame($this->trick->getName('trick'), $result);
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
        $this->trick->setSlug('test-trick');
        $result = $this->trick->getSlug();
        $this->assertSame('test-trick', $result);
    }

    /**
     *
     */
    public function testGetSlugIfIsNull()
    {
        $this->trick->setSlug(null);
        $this->assertNull($this->trick->getSlug());
    }
}