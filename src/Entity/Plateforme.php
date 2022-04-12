<?php

namespace App\Entity;

use App\Repository\PlateformeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlateformeRepository::class)]
class Plateforme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $lien;

    #[ORM\OneToMany(mappedBy: 'plateforme', targetEntity: VeilleTechno::class, orphanRemoval: true)]
    private $veilleTechno;

    #[ORM\OneToOne(targetEntity: Picture::class, cascade: ['persist', 'remove'])]
    private $picture;

    public function __construct()
    {
        $this->veilleTechno = new ArrayCollection();
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

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): self
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * @return Collection<int, VeilleTechno>
     */
    public function getVeilleTechno(): Collection
    {
        return $this->veilleTechno;
    }

    public function addVeilleTechno(VeilleTechno $veilleTechno): self
    {
        if (!$this->veilleTechno->contains($veilleTechno)) {
            $this->veilleTechno[] = $veilleTechno;
            $veilleTechno->setPlateforme($this);
        }

        return $this;
    }

    public function removeVeilleTechno(VeilleTechno $veilleTechno): self
    {
        if ($this->veilleTechno->removeElement($veilleTechno)) {
            // set the owning side to null (unless already changed)
            if ($veilleTechno->getPlateforme() === $this) {
                $veilleTechno->setPlateforme(null);
            }
        }

        return $this;
    }

    public function getPicture(): ?Picture
    {
        return $this->picture;
    }

    public function setPicture(?Picture $picture): self
    {
        $this->picture = $picture;

        return $this;
    }
}
