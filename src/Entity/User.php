<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank(message: "Login should not be blank.")]
    #[Assert\Length(max: 8, maxMessage: "Login should not exceed 8 characters.")]
    private ?string $login = null;

    #[ORM\Column(length: 8)]
    #[Assert\NotBlank(message: "Phone should not be blank.")]
    #[Assert\Length(max: 8, maxMessage: "Phone should not exceed 8 characters.")]
    private ?string $phone = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Password should not be blank.")]
    #[Assert\Length(min: 8, max: 255, minMessage: "Password should be at least 8 characters long.")]
    private ?string $pass= null;

    #[ORM\Column(type: 'json')]
    #[Assert\Type('array')]
    #[Assert\All([
        new Assert\NotBlank(),
        new Assert\Choice(choices: ['ROLE_TEST_USER', 'ROLE_TEST_ADMIN'], message: "Invalid role.")
    ])]
    private array $roles = [self::ROLE_TEST_USER];

    const ROLE_TEST_USER = 'ROLE_TEST_USER';
    const ROLE_TEST_ADMIN = 'ROLE_TEST_ADMIN';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPass(): ?string
    {
        return $this->pass;
    }

    public function setPass(string $pass): static
    {
        $this->pass = $pass;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;

        return array_unique($roles);
    }

    public function eraseCredentials(): void
    {

    }

    public function getUserIdentifier(): string
    {
        return $this->login;
    }

    public function getPassword(): ?string
    {
        return $this->pass;
    }
}
