<?php


namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Forgot
{
    /**
     * @var string|null
     *
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $email;

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

}