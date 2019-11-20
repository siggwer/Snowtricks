<?php

namespace App\EntityListener;

use Symfony\Component\Security\Core\Security;
use App\Entity\Trick;

/**
 * Class TrickListener.
 */
class TrickListener
{
    /**
     * @var Security
     */
    private $security;

    /**
     * TrickListener constructor.
     *
     * @param Security $security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @param Trick $trick
     */
    public function prePersist(Trick $trick)
    {
        if (!($this->security->getUser() instanceof User)) {
            return;
        }
        $trick->setAuthor($this->security->getUser());
    }
}
