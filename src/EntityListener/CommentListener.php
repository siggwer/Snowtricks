<?php


namespace App\EntityListener;

use App\Entity\Comment;
use App\Entity\User;
use Symfony\Component\Security\Core\Security;

/**
 * Class CommentListener
 *
 * @package App\EntityListener
 */
class CommentListener
{
    /**
     * @var Security
     */
    private $security;

    /**
     * CommentListener constructor.
     *
     * @param Security $security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @param Comment $comment
     */
    public function prePersist(Comment $comment)
    {
        if (!($this->security->getUser() instanceof User)) {
            return;
        }
        $comment->setAuthor($this->security->getUser());
    }
}