<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 *
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\EntityListeners({"App\EntityListener\UserListener"})
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 */
class User implements UserInterface
{
    /**
     * @var int|null
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     *
     * @Assert\NotBlank
     *
     * @ORM\Column(type="string", unique=true)
     */
    private $username;

    /**
     * @var string|null
     *
     * @Assert\NotBlank
     * @Assert\Email
     *
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string|null
     *
     * @Assert\NotBlank
     */
    private $plainPassword;

    /**
     * @var \DateTimeImmutable|null
     *
     * @ORM\Column(type="datetime_immutable")
     */
    private $registeredAt;

    /**
     * @var string|null
     */
    private $role = "ROLE_USER";

    /**
     * User constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->registeredAt = new \DateTimeImmutable();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

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

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @param string|null $plainPassword
     */
    public function setPlainPassword(?string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getRegisteredAt(): ?\DateTimeImmutable
    {
        return $this->registeredAt;
    }

    /**
     * @param \DateTimeImmutable|null $registeredAt
     */
    public function setRegisteredAt(?\DateTimeImmutable $registeredAt): void
    {
        $this->registeredAt = $registeredAt;
    }

    /**
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @param string|null $role
     */
    public function setRole(?string $role): void
    {
        $this->role = $role;
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
