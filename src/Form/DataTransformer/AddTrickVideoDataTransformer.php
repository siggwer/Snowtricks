<?php


namespace App\Form\DataTransformer;

use App\Entity\Trick;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Class AddTrickVideoDataTransformer
 *
 * @package App\Form\DataTransformer
 */
class AddTrickVideoDataTransformer implements DataTransformerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * AddTrickVideoDataTransformer constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param mixed $videos
     *
     * @return mixed|string
     */
    public function transform($videos)
    {
        if (null === $videos) {
            return '';
        }

        return $videos->getId();
    }

    /**
     * @param mixed $isVideoNumber
     *
     * @return mixed|void
     */
    public function reverseTransform($isVideoNumber)
    {
        // no issue number? It's optional, so that's ok
        if (!$isVideoNumber) {
            return;
        }

        $issue = $this->entityManager
            ->getRepository(Trick::class)
            // query for the issue with this id
            ->find($isVideoNumber)
        ;

        if (null === $videos) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'An issue with number "%s" does not exist!',
                $isVideoNumber
            ));
        }

        return $videos;
    }
}