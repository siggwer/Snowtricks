<?php

namespace App\EntityListener;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserListener.
 */
class UserListener
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    /**
     * UserListener constructor.
     *
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    /**
     * @param User $user
     */
    public function prePersist(user $user)
    {
        $this->encodePassword($user);
    }

    /**
     * @param User $user
     */
    public function preUpdate(user $user)
    {
        $this->encodePassword($user);
    }

    /**
     * @param User $user
     */
    private function encodePassword(User $user)
    {
        if (null === $user->getPlainPassword()) {
            return;
        }

        $user->setPassword(
            $this->userPasswordEncoder
                ->encodePassword($user, $user->getPlainPassword())
        );
    }
}
