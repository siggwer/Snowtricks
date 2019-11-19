<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class ContactEvent
 *
 * @package App\Event
 */
class ContactEvent extends event
{
    public const NAME = 'contact.event';

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * ContactEvent constructor.
     *
     * @param string $message
     * @param string $subject
     * @param string $name
     * @param string $email
     */
    public function __construct(
        string $message,
        string $subject,
        string $name,
        string $email
    ) {
        $this->message = $message;
        $this->subject = $subject;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
