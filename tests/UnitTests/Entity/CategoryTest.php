<?php

namespace App\Tests\UnitTests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Category;

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
    public function TestCategoryConstruct()
    {
        $category = $this->createMock(Category::class);
        $this->assertInstanceOf(Category::class, $category);
    }

    public function setUp()
    {
        $this->category = new Category();
    }

    /**
     * @throws \Exception
     */
    public function testGetTitleIfIsString()
    {
        $this->category->setName('name');
        $result = $this->category->getName();
        $this->assertSame('name', $result);
    }
    /**
     * @throws \Exception
     */
    public function testGetTitleIfIsNull()
    {
        $this->category->setName(null);
        $this->assertNull($this->category->getName());
    }
}