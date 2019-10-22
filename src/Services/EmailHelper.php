<?php


namespace App\Services;

use Swift_Mailer;
use Swift_Message;

/**
 * Class EmailHelper
 *
 * @package App\Services
 */
class EmailHelper
{
    /**
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * EmailHelper constructor.
     *
     * @param Swift_Mailer $mailer
     */
    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param $subject
     * @param array $from
     * @param $to
     * @param $body
     */
    public function mail($subject, $from = [], $to, $body)
    {
        $message = (new Swift_Message($subject))
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body);

        $this->mailer->send($message);
    }
}