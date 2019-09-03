<?php

namespace App\Event;

use App\Entity\User;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class AvatarEvent
 *
 * @package App
 */
class AvatarEvent extends Event
{
    const NAME = 'user.avatar';

    /**
     * @var User
     */
    private $user;

    /**
     * AvatarEvent constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
