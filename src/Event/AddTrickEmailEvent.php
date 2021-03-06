<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class AddTrickEmailEvent
 *
 * @package App\Event
 */
class AddTrickEmailEvent extends Event
{
    public const NAME = 'addTrick.event';

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $slug;

    /**
     * ForgotPasswordEmailEvent constructor.
     *
     * @param string $email
     * @param string $slug
     */
    public function __construct(
        string $email,
        string $slug
    ) {
        $this->email = $email;
        $this->slug = $slug;
    }

    /**
     * @return mixed|string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }
}
