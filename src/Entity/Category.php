<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $slug;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Post::class)]
    private $posts;

    #[ORM\ManyToMany(targetEntity: VeilleTechno::class, mappedBy: 'category')]
    private $veilleTechnos;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->veilleTechnos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setCategory($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getCategory() === $this) {
                $post->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, VeilleTechno>
     */
    public function getVeilleTechnos(): Collection
    {
        return $this->veilleTechnos;
    }

    public function addVeilleTechno(VeilleTechno $veilleTechno): self
    {
        if (!$this->veilleTechnos->contains($veilleTechno)) {
            $this->veilleTechnos[] = $veilleTechno;
            $veilleTechno->addCategory($this);
        }

        return $this;
    }

    public function removeVeilleTechno(VeilleTechno $veilleTechno): self
    {
        if ($this->veilleTechnos->removeElement($veilleTechno)) {
            $veilleTechno->removeCategory($this);
        }

        return $this;
    }
}
