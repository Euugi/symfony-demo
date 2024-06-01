<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', length: 36, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private Uuid $id;

    #[ORM\Column(length: 180)]
    private string $email;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private string $password;

    #[ORM\OneToOne(targetEntity: UserProfile::class, inversedBy: 'user', cascade: ['persist', 'remove'])]
    private ?UserProfile $userProfile = null;

    #[ORM\OneToOne(targetEntity: UserStatus::class, inversedBy: 'user', cascade: ['persist', 'remove'])]
    private ?UserStatus $userStatus = null;

    /** @var Collection<int, Training> */
    #[ORM\OneToMany(targetEntity: Training::class, mappedBy: 'user', cascade: ['persist', 'remove'])]
    private Collection $trainings;

    public function __construct()
    {
        $this->userProfile = new UserProfile();
        $this->userStatus = new UserStatus();
        $this->trainings = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @return list<string>
     *
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
    }

    public function getUserProfile(): UserProfile
    {
        return $this->userProfile;
    }

    public function setUserProfile(UserProfile $userProfile): void
    {
        $this->userProfile = $userProfile;
    }

    public function getUserStatus(): UserStatus
    {
        return $this->userStatus;
    }

    public function setUserStatus(UserStatus $userStatus): void
    {
        $this->userStatus = $userStatus;
    }

    /**
     * @return Collection<int, Training>
     */
    public function getTrainings(): Collection
    {
        return $this->trainings;
    }

    /**
     * @param Collection<int, Training> $trainings
     */
    public function setTrainings(Collection $trainings): void
    {
        $this->trainings = $trainings;
    }
}
