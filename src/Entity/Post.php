<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    private $picture;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $stlFile;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'posts')]
    private $Utilisateur;

    #[ORM\Column(type: 'date')]
    #[Gedmo\Timestampable(on: 'create')]
    private $createdAt;

    #[ORM\Column(type: 'date', nullable: true)]
    #[Gedmo\Timestampable(on: 'update')]
    private $updatedAt;

    #[ORM\Column(type: 'text', nullable: true)]
    private $code;

    #[ORM\ManyToOne(targetEntity: PostCateogies::class, inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\Column(type: 'boolean')]
    private $isOnline;

    #[ORM\Column(type: 'text', nullable: true)]
    private $secondDescription;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getStlFile(): ?string
    {
        return $this->stlFile;
    }

    public function setStlFile(string $stlFile): self
    {
        $this->stlFile = $stlFile;

        return $this;
    }

    public function getUtilisateur(): ?User
    {
        return $this->Utilisateur;
    }

    public function setUtilisateur(?User $Utilisateur): self
    {
        $this->Utilisateur = $Utilisateur;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCategory(): ?PostCateogies
    {
        return $this->category;
    }

    public function setCategory(?PostCateogies $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getIsOnline(): ?bool
    {
        return $this->isOnline;
    }

    public function setIsOnline(bool $isOnline): self
    {
        $this->isOnline = $isOnline;

        return $this;
    }

    public function getSecondDescription(): ?string
    {
        return $this->secondDescription;
    }

    public function setSecondDescription(?string $secondDescription): self
    {
        $this->secondDescription = $secondDescription;

        return $this;
    }
}
