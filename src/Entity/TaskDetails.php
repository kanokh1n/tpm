<?php

namespace App\Entity;

use App\Repository\TaskDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskDetailsRepository::class)]
class TaskDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'taskDetails', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?tasks $task_id = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(length: 255)]
    private ?string $topic = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $scheduled_time = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $actual_time = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaskId(): ?tasks
    {
        return $this->task_id;
    }

    public function setTaskId(tasks $task_id): static
    {
        $this->task_id = $task_id;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getTopic(): ?string
    {
        return $this->topic;
    }

    public function setTopic(string $topic): static
    {
        $this->topic = $topic;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getScheduledTime(): ?string
    {
        return $this->scheduled_time;
    }

    public function setScheduledTime(string $scheduled_time): static
    {
        $this->scheduled_time = $scheduled_time;

        return $this;
    }

    public function getActualTime(): ?string
    {
        return $this->actual_time;
    }

    public function setActualTime(?string $actual_time): static
    {
        $this->actual_time = $actual_time;

        return $this;
    }
}
