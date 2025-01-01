<?php

namespace App\Entity;

use App\Repository\PostsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostsRepository::class)]
class Posts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $post_name = null;

    /**
     * @var Collection<int, UsersPosts>
     */
    #[ORM\ManyToMany(targetEntity: UsersPosts::class, mappedBy: 'post_id')]
    private Collection $usersPosts;

    public function __construct()
    {
        $this->usersPosts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostName(): ?string
    {
        return $this->post_name;
    }

    public function setPostName(string $post_name): static
    {
        $this->post_name = $post_name;

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
            $usersPost->addPostId($this);
        }

        return $this;
    }

    public function removeUsersPost(UsersPosts $usersPost): static
    {
        if ($this->usersPosts->removeElement($usersPost)) {
            $usersPost->removePostId($this);
        }

        return $this;
    }
}
