<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $login = null;

    #[ORM\Column(length: 255)]
    private ?string $pass_hash = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\OneToOne(mappedBy: 'user_id', cascade: ['persist', 'remove'])]
    private ?UsersDetails $usersDetails = null;

    /**
     * @var Collection<int, UsersPosts>
     */
    #[ORM\ManyToMany(targetEntity: UsersPosts::class, mappedBy: 'user_id')]
    private Collection $usersPosts;

    /**
     * @var Collection<int, Projects>
     */
    #[ORM\OneToMany(targetEntity: Projects::class, mappedBy: 'user_id')]
    private Collection $projects;

    /**
     * @var Collection<int, Tasks>
     */
    #[ORM\OneToMany(targetEntity: Tasks::class, mappedBy: 'creator_id', orphanRemoval: true)]
    private Collection $tasks;

    /**
     * @var Collection<int, TaskComments>
     */
    #[ORM\OneToMany(targetEntity: TaskComments::class, mappedBy: 'user_id', orphanRemoval: true)]
    private Collection $taskComments;

    public function __construct()
    {
        $this->usersPosts = new ArrayCollection();
        $this->projects = new ArrayCollection();
        $this->tasks = new ArrayCollection();
        $this->taskComments = new ArrayCollection();
    }

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

    public function getPassHash(): ?string
    {
        return $this->pass_hash;
    }

    public function setPassHash(string $pass_hash): static
    {
        $this->pass_hash = $pass_hash;

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

    public function getUsersDetails(): ?UsersDetails
    {
        return $this->usersDetails;
    }

    public function setUsersDetails(UsersDetails $usersDetails): static
    {
        // set the owning side of the relation if necessary
        if ($usersDetails->getUserId() !== $this) {
            $usersDetails->setUserId($this);
        }

        $this->usersDetails = $usersDetails;

        return $this;
    }

    /**
     * @return Collection<int, UsersPosts>
     */
    public function getUsersPosts(): Collection
    {
        return $this->usersPosts;
    }

    public function addUsersPost(UsersPosts $usersPost): static
    {
        if (!$this->usersPosts->contains($usersPost)) {
            $this->usersPosts->add($usersPost);
            $usersPost->addUserId($this);
        }

        return $this;
    }

    public function removeUsersPost(UsersPosts $usersPost): static
    {
        if ($this->usersPosts->removeElement($usersPost)) {
            $usersPost->removeUserId($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Projects>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Projects $project): static
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->setUserId($this);
        }

        return $this;
    }

    public function removeProject(Projects $project): static
    {
        if ($this->projects->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getUserId() === $this) {
                $project->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tasks>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Tasks $task): static
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks->add($task);
            $task->setCreatorId($this);
        }

        return $this;
    }

    public function removeTask(Tasks $task): static
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getCreatorId() === $this) {
                $task->setCreatorId(null);
            }
        }

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
            $taskComment->setUserId($this);
        }

        return $this;
    }

    public function removeTaskComment(TaskComments $taskComment): static
    {
        if ($this->taskComments->removeElement($taskComment)) {
            // set the owning side to null (unless already changed)
            if ($taskComment->getUserId() === $this) {
                $taskComment->setUserId(null);
            }
        }

        return $this;
    }

}
