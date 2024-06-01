<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TrainingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: TrainingRepository::class)]
#[ORM\Table(name: '`training`')]
class Training
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'uuid', unique: true)]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?string $day = null;

    #[ORM\Column(nullable: true)]
    private ?string $hour = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $date = null;

    #[ORM\Column(nullable: true)]
    private ?string $time = null;

    #[ORM\Column(nullable: true)]
    private ?string $exercises = null;

    #[ORM\Column(nullable: true)]
    private ?string $rate = null;

    #[ORM\Column(nullable: true)]
    private ?string $type = null;

    #[ORM\Column(nullable: true)]
    private ?string $daleted = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'trainings')]
    private ?User $user = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function setId(?Uuid $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(?string $day): void
    {
        $this->day = $day;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(?\DateTime $date): void
    {
        $this->date = $date;
    }

    public function getHour(): ?string
    {
        return $this->hour;
    }

    public function setHour(?string $hour): void
    {
        $this->hour = $hour;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(?string $time): void
    {
        $this->time = $time;
    }

    public function getExercises(): ?string
    {
        return $this->exercises;
    }

    public function setExercises(?string $exercises): void
    {
        $this->exercises = $exercises;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function getRate(): ?string
    {
        return $this->rate;
    }

    public function setRate(?string $rate): void
    {
        $this->rate = $rate;
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
