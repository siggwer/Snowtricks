<?php

namespace App\Tests\UnitTests\Service;

use App\Services\TokenGenerator;
use PHPUnit\Framework\TestCase;

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

        static::assertNotNull($token->generate());
    }
}
