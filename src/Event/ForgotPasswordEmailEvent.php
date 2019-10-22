<?php


namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class ForgotPasswordEmailEvent
 *
 * @package App
 */
class ForgotPasswordEmailEvent extends Event
{
    /**
     *
     */
    public const NAME = 'forgotPassword.event';

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $token;

    /**
     * ForgotPasswordEmailEvent constructor.
     *
     * @param string $email
     * @param string $token
     */
    public function __construct(
        string $email,
        string $token
    ) {
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * @return mixed|string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return mixed|string
     */
    public function getToken(): string
    {
        return $this->token;
    }
}