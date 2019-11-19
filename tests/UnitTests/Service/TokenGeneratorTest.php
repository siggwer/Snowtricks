<?php

namespace App\Tests\UnitTests\Service;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Services\TokenGenerator;

/**
 * Class TokenGeneratorTest
 *
 * @package App\Tests\UnitTests\ServiceTest
 */
class TokenGeneratorTest extends TestCase
{
    /**
     *
     */
    public function testTokenService()
    {
        $token = new TokenGenerator();

        static::assertNotNull($token::generate());
    }
}