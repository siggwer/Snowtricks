<?php

namespace App\Tests\UnitTests\ServiceTest;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Services\EmailHelper;
use Swift_Mailer;
use Twig\Environment;

/**
 * Class EmailHelperTest
 *
 * @package App\Tests\UnitTests\ServiceTest
 */
class EmailHelperTest extends KernelTestCase
{
    /**
     * @var
     */
    private $swiftMailer;

    private $templating;

    /**
     *
     */
    public function setUp()
    {
        $this->swiftMailer = $this->createMock(Swift_Mailer::class);
        $this->templating = $this->createMock(Environment::class);
    }

    /**
     *
     */
    public function test__construct()
    {
        $emailer = new EmailHelper(
            $this->templating,
            $this->swiftMailer
        );
        static::assertInstanceOf(
            EmailHelper::class,
            $emailer
        );
    }
}