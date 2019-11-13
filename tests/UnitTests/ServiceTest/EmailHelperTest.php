<?php

namespace App\Tests\UnitTests\ServiceTest;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Services\EmailHelper;
use Twig\Error\RuntimeError;
use Twig\Error\LoaderError;
use Twig\Error\SyntaxError;
use Twig\Environment;
use Swift_Message;
use Swift_Mailer;

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

    /**
     * @var Environment
     */
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

    /**
     * @return Swift_Message.
     */
    public function testBuildMail()
    {
        $emailer = new Swift_Message();
        $to ='test@yopmail.com';
        $from = 'test@yopmail.com';
        $subject = 'test';
        $charset = 'utf-8';
        $contentType = 'text/html';
        $body = 'contact/contact_email.html.twig';

        $emailer->setTo($to);
        $emailer->setFrom($from);
        $emailer->setSubject($subject);
        $emailer->setCharset($charset);
        $emailer->setContentType($contentType);
        $emailer->setBody($body);

        $this->assertSame('test@yopmail.com', $to);
        $this->assertSame('test@yopmail.com', $from);
        $this->assertSame('test', $subject);
        $this->assertSame('utf-8', $charset);
        $this->assertSame('text/html', $contentType);
        $this->assertSame('contact/contact_email.html.twig', $body);

        return $emailer;
    }

    public function TestMail()
    {
        $mail = $this->testBuildMail();

        return $this->swiftMailer->send($mail);
    }
}