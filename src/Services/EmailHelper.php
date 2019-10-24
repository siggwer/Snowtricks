<?php

namespace App\Services;

use Swift_Mailer;
use Swift_Message;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Exception;

/**
 * Class EmailHelper
 *
 * @package App\Services
 */
class EmailHelper
{
    /**
     * @var Environment
     */
    private $templating;

    /**
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * EmailHelper constructor.
     *
     * @param Environment $templating
     * @param Swift_Mailer $mailer
     */
    public function __construct(Environment $templating,Swift_Mailer $mailer)
    {
        $this->templating = $templating;
        $this->mailer = $mailer;
    }

    /**
     * @param string $subject
     * @param array $from
     * @param array $to
     * @param string $template
     * @param array $paramsTemplate
     *
     * @return Swift_Message
     */
    private function builtMail(
        string $subject,
        array $from,
        array $to,
        string $template,
        array $paramsTemplate = []
    ): Swift_Message
    {
        $email = new Swift_Message();
        $email->setTo($to['email'], $to['name']);
        $email->setFrom($from['email'], $from['name']);
        $email->setSubject($subject);
        $email->setCharset('utf-8');
        $email->setContentType('text/html');
        try {
            $email->setBody($this->templating->render($template, $paramsTemplate));
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
        return $email;
    }

    /**
     * @param string $subject
     * @param array $from
     * @param array $to
     * @param string $template
     * @param array $paramsTemplate
     *
     * @return int
     */
    public function mail(
        string $subject,
        array $from,
        array $to,
        string $template,
        array $paramsTemplate = []
    ): ?int
    {
        $mail = $this->builtMail($subject, $from, $to, $template, $paramsTemplate);
        try {
            return $this->mailer->send($mail);
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
            exit;
        }
    }
}