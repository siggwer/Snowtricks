<?php

namespace App\Tests\UnitTests\Service;

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
        $email = new Swift_Message();
        $to ='test@yopmail.com';
        $from = 'test@yopmail.com';
        $subject = 'test';
        $charset = 'utf-8';
        $contentType = 'text/html';
        $body = 'contact/contact_email.html.twig';

        $email->setTo($to);
        $email->setFrom($from);
        $email->setSubject($subject);
        $email->setCharset($charset);
        $email->setContentType($contentType);
        $email->setBody($body);

        $this->assertSame('test@yopmail.com', $to);
        $this->assertSame('test@yopmail.com', $from);
        $this->assertSame('test', $subject);
        $this->assertSame('utf-8', $charset);
        $this->assertSame('text/html', $contentType);
        $this->assertSame('contact/contact_email.html.twig', $body);

        return $email;
    }

    public function TestMail()
    {
        $mail = $this->testBuildMail();

        return $this->swiftMailer->send($mail);
    }
}