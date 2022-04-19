<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $picture;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Gedmo\Timestampable(on: 'create')]
    private $createdAt;

    #[ORM\Column(type: 'date')]
    #[Gedmo\Timestampable(on: 'update')]
    private $updatedAt;

    #[ORM\OneToMany(mappedBy: 'Utilisateur', targetEntity: FormImprimante::class)]
    private $formImprimantes;

    #[ORM\OneToMany(mappedBy: 'Utilisateur', targetEntity: Post::class)]
    private $posts;

    #[ORM\OneToOne(mappedBy: 'Utilisateur', targetEntity: Contact::class, cascade: ['persist', 'remove'])]
    private $contact;

    public function __construct()
    {
        $this->formImprimantes = new ArrayCollection();
        $this->posts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, FormImprimante>
     */
    public function getFormImprimantes(): Collection
    {
        return $this->formImprimantes;
    }

    public function addFormImprimante(FormImprimante $formImprimante): self
    {
        if (!$this->formImprimantes->contains($formImprimante)) {
            $this->formImprimantes[] = $formImprimante;
            $formImprimante->setUtilisateur($this);
        }

        return $this;
    }

    public function removeFormImprimante(FormImprimante $formImprimante): self
    {
        if ($this->formImprimantes->removeElement($formImprimante)) {
            // set the owning side to null (unless already changed)
            if ($formImprimante->getUtilisateur() === $this) {
                $formImprimante->setUtilisateur(null);
            }
        }

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
            $post->setUtilisateur($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getUtilisateur() === $this) {
                $post->setUtilisateur(null);
            }
        }

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(Contact $contact): self
    {
        // set the owning side of the relation if necessary
        if ($contact->getUtilisateur() !== $this) {
            $contact->setUtilisateur($this);
        }

        $this->contact = $contact;

        return $this;
    }

    public function __toString(): string
    {
        return  $this->getPrenom() . " " . $this->getName();
    }
}
