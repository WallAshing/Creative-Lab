<?php

namespace App\Entity;

use App\Repository\ImprimanteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImprimanteRepository::class)]
class Imprimante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'imprimante', targetEntity: FormImprimante::class)]
    private $formImprimante;

    #[ORM\Column(type: 'date')]
    private $time;

    #[ORM\Column(type: 'boolean')]
    private $working;

    #[ORM\Column(type: 'date')]
    private $createdAt;

    #[ORM\Column(type: 'date', nullable: true)]
    private $updatedAt;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    public function __construct()
    {
        $this->formImprimante = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, FormImprimante>
     */
    public function getFormImprimante(): Collection
    {
        return $this->formImprimante;
    }

    public function addFormImprimante(FormImprimante $formImprimante): self
    {
        if (!$this->formImprimante->contains($formImprimante)) {
            $this->formImprimante[] = $formImprimante;
            $formImprimante->setImprimante($this);
        }

        return $this;
    }

    public function removeFormImprimante(FormImprimante $formImprimante): self
    {
        if ($this->formImprimante->removeElement($formImprimante)) {
            // set the owning side to null (unless already changed)
            if ($formImprimante->getImprimante() === $this) {
                $formImprimante->setImprimante(null);
            }
        }

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $timne): self
    {
        $this->time = $timne;

        return $this;
    }

    public function getWorking(): ?bool
    {
        return $this->working;
    }

    public function setWorking(bool $working): self
    {
        $this->working = $working;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
