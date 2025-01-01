<?php

namespace App\Entity;

use App\Repository\UsersPostsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersPostsRepository::class)]
class UsersPosts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, posts>
     */
    #[ORM\ManyToMany(targetEntity: posts::class, inversedBy: 'usersPosts')]
    private Collection $post_id;

    /**
     * @var Collection<int, users>
     */
    #[ORM\ManyToMany(targetEntity: users::class, inversedBy: 'usersPosts')]
    private Collection $user_id;

    public function __construct()
    {
        $this->post_id = new ArrayCollection();
        $this->user_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, posts>
     */
    public function getPostId(): Collection
    {
        return $this->post_id;
    }

    public function addPostId(posts $postId): static
    {
        if (!$this->post_id->contains($postId)) {
            $this->post_id->add($postId);
        }

        return $this;
    }

    public function removePostId(posts $postId): static
    {
        $this->post_id->removeElement($postId);

        return $this;
    }

    /**
     * @return Collection<int, users>
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(users $userId): static
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id->add($userId);
        }

        return $this;
    }

    public function removeUserId(users $userId): static
    {
        $this->user_id->removeElement($userId);

        return $this;
    }
}
