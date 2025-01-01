<?php

namespace App\Entity;

use App\Repository\TasksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TasksRepository::class)]
class Tasks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'tasks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?projects $project_id = null;

    #[ORM\ManyToOne(inversedBy: 'tasks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?users $creator_id = null;

    #[ORM\ManyToOne(inversedBy: 'tasks')]
    private ?users $executor_id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $closing_at = null;

    #[ORM\OneToOne(mappedBy: 'task_id', cascade: ['persist', 'remove'])]
    private ?TaskDetails $taskDetails = null;

    /**
     * @var Collection<int, TaskComments>
     */
    #[ORM\OneToMany(targetEntity: TaskComments::class, mappedBy: 'task_id', orphanRemoval: true)]
    private Collection $taskComments;

    public function __construct()
    {
        $this->taskComments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjectId(): ?projects
    {
        return $this->project_id;
    }

    public function setProjectId(?projects $project_id): static
    {
        $this->project_id = $project_id;

        return $this;
    }

    public function getCreatorId(): ?users
    {
        return $this->creator_id;
    }

    public function setCreatorId(?users $creator_id): static
    {
        $this->creator_id = $creator_id;

        return $this;
    }

    public function getExecutorId(): ?users
    {
        return $this->executor_id;
    }

    public function setExecutorId(?users $executor_id): static
    {
        $this->executor_id = $executor_id;

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

    public function getClosingAt(): ?\DateTimeImmutable
    {
        return $this->closing_at;
    }

    public function setClosingAt(\DateTimeImmutable $closing_at): static
    {
        $this->closing_at = $closing_at;

        return $this;
    }

    public function getTaskDetails(): ?TaskDetails
    {
        return $this->taskDetails;
    }

    public function setTaskDetails(TaskDetails $taskDetails): static
    {
        // set the owning side of the relation if necessary
        if ($taskDetails->getTaskId() !== $this) {
            $taskDetails->setTaskId($this);
        }

        $this->taskDetails = $taskDetails;

        return $this;
    }

    /**
     * @return Collection<int, TaskComments>
     */
    public function getTaskComments(): Collection
    {
        return $this->taskComments;
    }

    public function addTaskComment(TaskComments $taskComment): static
    {
        if (!$this->taskComments->contains($taskComment)) {
            $this->taskComments->add($taskComment);
            $taskComment->setTaskId($this);
        }

        return $this;
    }

    public function removeTaskComment(TaskComments $taskComment): static
    {
        if ($this->taskComments->removeElement($taskComment)) {
            // set the owning side to null (unless already changed)
            if ($taskComment->getTaskId() === $this) {
                $taskComment->setTaskId(null);
            }
        }

        return $this;
    }
}
