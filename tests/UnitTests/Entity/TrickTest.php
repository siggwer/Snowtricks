<?php

namespace App\Tests\UnitTests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Entity\Trick;

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
     * @throws \Exception
     */
    public function setUp()
    {
        $this->trick = new Trick();
    }

    /**
     * @throws \Exception
     */
    public function testGetName()
    {
        $this->trick->setName('test');
        $result = $this->trick->getName();
        $this->assertSame('test', $result);
    }

    /**
     * @throws \Exception
     */
    public function testGetNameIfIsNull()
    {
        $this->trick->setName(null);
        $this->assertNull($this->trick->getName());
    }

    /**
     * @throws \Exception
     */
    public function testGetDescription()
    {
        $this->trick->setDescription('test');
        $result = $this->trick->getDescription();
        $this->assertSame('test', $result);
    }

    /**
     * @throws \Exception
     */
    public function testGetDescriptionIfIsNull()
    {
        $this->trick->setDescription(null);
        $this->assertNull($this->trick->getDescription());
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