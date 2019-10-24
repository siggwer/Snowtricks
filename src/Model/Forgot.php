<?php

namespace App\Model;

use App\Validator\Constraints AS AcmeAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Forgot
 *
 * @package App\Model
 */
class Forgot
{
    /**
     * @var string|null
     *
     * @Assert\NotBlank
     *
     * @AcmeAssert\ConstainsEmail
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