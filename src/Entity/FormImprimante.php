<?php

namespace App\Entity;

use App\Repository\FormImprimanteRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: FormImprimanteRepository::class)]
class FormImprimante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'formImprimantes')]
    private $Utilisateur;

    #[ORM\Column(type: 'string', length: 255)]
    private $impressionName;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    private $stlFile;

    #[ORM\Column(type: 'date')]
    #[Gedmo\Timestampable(on: 'create')]
    private $createdAt;

    #[ORM\Column(type: 'date', nullable: true)]
    #[Gedmo\Timestampable(on: 'update')]
    private $updatedAt;

    #[ORM\ManyToOne(targetEntity: Imprimante::class, inversedBy: 'formImprimante')]
    #[ORM\JoinColumn(nullable: false)]
    private $imprimante;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getImpressionName(): ?string
    {
        return $this->impressionName;
    }

    public function setImpressionName(string $impressionName): self
    {
        $this->impressionName = $impressionName;

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

    public function getStlFile(): ?string
    {
        return $this->stlFile;
    }

    public function setStlFile(string $stlFile): self
    {
        $this->stlFile = $stlFile;

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

    public function getImprimante(): ?Imprimante
    {
        return $this->imprimante;
    }

    public function setImprimante(?Imprimante $imprimante): self
    {
        $this->imprimante = $imprimante;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getImpressionName();
    }
}
