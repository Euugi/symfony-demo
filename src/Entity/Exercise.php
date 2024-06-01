<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ExerciseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ExerciseRepository::class)]
#[ORM\Table(name: '`exercise`')]
class Exercise
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', length: 36, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageFile = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $daleted = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $accepted = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getImageFile(): ?string
    {
        return $this->imageFile;
    }

    public function setImageFile(?string $imageFile): void
    {
        $this->imageFile = $imageFile;
    }

    public function getDaleted(): ?bool
    {
        return $this->daleted;
    }

    public function setDaleted(?bool $daleted): void
    {
        $this->daleted = $daleted;
    }

    public function getAccepted(): ?bool
    {
        return $this->accepted;
    }

    public function setAccepted(?bool $accepted): void
    {
        $this->accepted = $accepted;
    }
}
