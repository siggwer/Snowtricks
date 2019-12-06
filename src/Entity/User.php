<?php

namespace App\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
use Serializable;
use Exception;

/**
 * Class User.
 *
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\EntityListeners({"App\EntityListener\UserListener"})
 *
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 */
class User implements UserInterface, Serializable
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
     *
     * @Assert\Length(min=6)
     */
    private $plainPassword;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $passwordToken;

    /**
     * @var DateTimeImmutable|null
     *
     * @ORM\Column(type="datetime_immutable")
     */
    private $registeredAt;

    /**
     * @var Picture|null
     *
     * @Assert\Valid(groups={"avatar"})
     *
     * @ORM\OneToOne(targetEntity="Picture", cascade={"persist"})
     */
    private $avatar;

    /**
     * @var UploadedFile|null
     *
     * @Assert\Image
     * @Assert\Valid()
     * @Assert\NotNull(groups={"add"})
     */
    private $uploadedFile;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $token;

    /**
     * @var string|null
     */
    private $role = 'ROLE_USER';

    /**
     * User constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->registeredAt = new DateTimeImmutable();
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
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @return string|null
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @return string|null
     */
    public function getPasswordToken(): ?string
    {
        return $this->passwordToken;
    }

    /**
     * @return UploadedFile|null
     */
    public function getUploadedFile(): ?UploadedFile
    {
        return $this->uploadedFile;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getRegisteredAt(): ?DateTimeImmutable
    {
        return $this->registeredAt;
    }

    /**
     * @return Picture|null
     */
    public function getAvatar(): ?Picture
    {
        return $this->avatar;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @param string|null $plainPassword
     */
    public function setPlainPassword(?string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @param string|null $passwordToken
     */
    public function setPasswordToken(?string $passwordToken): void
    {
        $this->passwordToken = $passwordToken;
    }

    /**
     * @param DateTimeImmutable|null $registeredAt
     */
    public function setRegisteredAt(?DateTimeImmutable $registeredAt): void
    {
        $this->registeredAt = $registeredAt;
    }

    /**
     * @param Picture|null $avatar
     */
    public function setAvatar(?Picture $avatar): void
    {
        $this->avatar = $avatar;
    }

    /**
     * @param UploadedFile|null $uploadedFile
     */
    public function setUploadedFile(?UploadedFile $uploadedFile): void
    {
        $this->uploadedFile = $uploadedFile;
    }

    /**
     * @param string|null $token
     */
    public function setToken(?string $token): void
    {
        $this->token = $token;
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
     * @return array (Role|string)[] The user roles
     */
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     *
     * @codeCoverageIgnore
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
     *
     * @codeCoverageIgnore
     */
    public function eraseCredentials(): void
    {

    }

    /**
     * @return string
     *
     * @codeCoverageIgnore
     */
    public function serialize(): string
    {
        return serialize(
            array(
            $this->id,
            $this->username,
            $this->password,
            $this->email,
            // see section on salt below
            // $this->salt,
            )
        );
    }

    /**
     * @param $serialized
     *
     * @codeCoverageIgnore
     */
    public function unserialize($serialized): void
    {
        list(
            $this->id,
            $this->username,
            $this->password,
            $this->email
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, array('allowed_classes' => false));
    }
}
