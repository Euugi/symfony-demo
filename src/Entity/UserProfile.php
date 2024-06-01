<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\GenderType;
use App\Repository\UserProfileRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: UserProfileRepository::class)]
#[ORM\Table(name: '`user_profile`')]
class UserProfile
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', length: 36, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?string $surname = null;

    #[ORM\Column(nullable: true)]
    private ?string $age = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true, enumType: GenderType::class)]
    private ?GenderType $gender = null;

    #[ORM\Column(nullable: true)]
    private ?float $weight = null;

    #[ORM\Column(nullable: true)]
    private ?float $height = null;

    #[ORM\Column(nullable: true)]
    private ?float $BMI = null;

    #[ORM\OneToOne(targetEntity: User::class, mappedBy: 'userProfile')]
    private ?User $user = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function setId(?Uuid $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): void
    {
        $this->surname = $surname;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(?string $age): void
    {
        $this->age = $age;
    }

    public function getGender(): ?GenderType
    {
        return $this->gender;
    }

    public function setGender(?GenderType $gender): void
    {
        $this->gender = $gender;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): void
    {
        $this->weight = $weight;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(?float $height): void
    {
        $this->height = $height;
    }

    public function getBMI(): ?float
    {
        return $this->BMI;
    }

    public function setBMI(?float $BMI): void
    {
        $this->BMI = $BMI;
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
