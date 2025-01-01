<?php

namespace App\Entity;

use App\Repository\TaskCommentsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskCommentsRepository::class)]
class TaskComments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'taskComments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?tasks $task_id = null;

    #[ORM\ManyToOne(inversedBy: 'taskComments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?users $user_id = null;

    #[ORM\Column(length: 500)]
    private ?string $text = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $photos = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaskId(): ?tasks
    {
        return $this->task_id;
    }

    public function setTaskId(?tasks $task_id): static
    {
        $this->task_id = $task_id;

        return $this;
    }

    public function getUserId(): ?users
    {
        return $this->user_id;
    }

    public function setUserId(?users $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getPhotos(): ?string
    {
        return $this->photos;
    }

    public function setPhotos(?string $photos): static
    {
        $this->photos = $photos;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
