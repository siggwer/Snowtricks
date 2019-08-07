<?php

namespace App\EntityListener;

use App\Entity\Picture;

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
     */
    public function preRemove(Picture $picture)
    {
        unlink($this->uploadDir . '/' . $picture->getPath());
    }
}