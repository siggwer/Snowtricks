<?php

namespace App\Listener;

use App\Event\AvatarEvent;

/**
 * Class AfterLoginListener
 *
 * @package App\Listener
 */
class AfterLoginListener
{
    public function userAvatar(AvatarEvent $event): void
    {
        $event->getUser()->getAvatar();
    }
}