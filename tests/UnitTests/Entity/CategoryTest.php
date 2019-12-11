<?php

namespace App\Tests\UnitTests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Category;
use ReflectionException;
use ReflectionClass;
use Exception;

/**
 * Class CategoryTest
 *
 * @package App\Tests\UnitTests\Entity
 */
class CategoryTest extends TestCase
{

    /**
     * @var Category
     */
    private $category;

    /**
     *
     */
    public function setUp()
    {
        $this->category = new Category();
    }

    /**
     *
     * @throws ReflectionException
     */
    public function testGetId()
    {
        $category = new Category();
        $this->assertNull($category->getId());
        $reflecion = new ReflectionClass($category);
        $property = $reflecion->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($category, '1');
        $this->assertEquals(1, $category->getId());
    }

    /**
     * @throws Exception
     */
    public function testGetTitleIfIsString()
    {
        $this->category->setName('name');
        $result = $this->category->getName();
        $this->assertSame('name', $result);
    }
    /**
     * @throws Exception
     */
    public function testGetTitleIfIsNull()
    {
        $this->category->setName(null);
        $this->assertNull($this->category->getName());
    }
}