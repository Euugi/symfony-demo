<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserStatusRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: UserStatusRepository::class)]
#[ORM\Table(name: '`user_status`')]
class UserStatus
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', length: 36, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(nullable: true)]
    private ?string $confirmed = null;

    #[ORM\Column(nullable: true)]
    private ?string $active = null;

    #[ORM\Column(nullable: true)]
    private ?string $daleted = null;

    #[ORM\OneToOne(targetEntity: User::class, mappedBy: 'userStatus')]
    private ?User $user = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function setId(?Uuid $id): void
    {
        $this->id = $id;
    }

    public function getConfirmed(): ?string
    {
        return $this->confirmed;
    }

    public function setConfirmed(?string $confirmed): void
    {
        $this->confirmed = $confirmed;
    }

    public function getActive(): ?string
    {
        return $this->active;
    }

    public function setActive(?string $active): void
    {
        $this->active = $active;
    }

    public function getDaleted(): ?string
    {
        return $this->daleted;
    }

    public function setDaleted(?string $daleted): void
    {
        $this->daleted = $daleted;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}
