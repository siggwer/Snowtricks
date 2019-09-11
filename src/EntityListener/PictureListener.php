<?php

namespace App\EntityListener;

use App\Entity\Picture;
use Doctrine\ORM\Event\PreUpdateEventArgs;

/**
 * Class TrickListener
 *
 * @package App\EntityListener
 */
class PictureListener
{
    /**
     * @var string
     */
    private $uploadDir;

    /**
     * PictureListener constructor.
     *
     * @param string $uploadDir
     */
    public function __construct(string $uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }

    /**
     * @param Picture $picture
     */
    public function prePersist(Picture $picture)
    {
        $filename = md5(uniqid("", true)). "." . $picture
                ->getUploadedFile()
                ->getClientOriginalExtension();

        $picture->getUploadedFile()->move($this->uploadDir, $filename);
        $picture->setPath("uploads/".$filename);

    }

    /**
     * @param Picture $picture
     *
     * @param PreUpdateEventArgs $eventArgs
     */
    public function preUpdate(Picture $picture, PreUpdateEventArgs $eventArgs)
    {
<<<<<<< HEAD
        if ($eventArgs->getOldValue("path") !== null && $picture->getUploadedFile() !== null) {
            unlink($this->uploadDir . '/' . $picture->getPath());
        }
        $this->upload($picture);
=======
       if ($eventArgs->getOldValue("path") !== null && $picture->getUploadedFile() !== null) {
           unlink($this->uploadDir . '/' . $picture->getPath());
       }
       $this->upload($picture);
>>>>>>> master

    }

    /**
     * @param Picture $picture
     */
    private function upload(Picture $picture)
    {
        if ($picture->getUploadedFile() === null) {
            return;
        }
<<<<<<< HEAD
        $filename = md5(uniqid("", true)). "." . $picture
                ->getUploadedFile()
                ->getClientOriginalExtension();

        $picture->getUploadedFile()->move($this->uploadDir, $filename);
        $picture->setPath("uploads/".$filename);

=======
            $filename = md5(uniqid("", true)). "." . $picture
                    ->getUploadedFile()
                    ->getClientOriginalExtension();

            $picture->getUploadedFile()->move($this->uploadDir, $filename);
            $picture->setPath("uploads/".$filename);
        
>>>>>>> master
    }

    /**
     * @param Picture $picture
     */
    public function preRemove(Picture $picture)
    {
        unlink($this->uploadDir . '/' . $picture->getPath());
    }
}