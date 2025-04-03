<?php

namespace App\Entity;

use App\Repository\ProjetChecklistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetChecklistRepository::class)]
class ProjetChecklist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $client = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'projetChecklists')]
    private ?ChecklistTemplate $checklistTemplate = null;

    #[ORM\ManyToOne(inversedBy: 'projetChecklists')]
    private ?User $user = null;

    /**
     * @var Collection<int, ProjetChecklistItem>
     */
    #[ORM\OneToMany(targetEntity: ProjetChecklistItem::class, mappedBy: 'projectChecklist', orphanRemoval: true)]
    private Collection $projetChecklistItems;

    public function __construct()
    {
        $this->projetChecklistItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getClient(): ?string
    {
        return $this->client;
    }

    public function setClient(string $client): static
    {
        $this->client = $client;

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

    public function getChecklistTemplate(): ?ChecklistTemplate
    {
        return $this->checklistTemplate;
    }

    public function setChecklistTemplate(?ChecklistTemplate $checklistTemplate): static
    {
        $this->checklistTemplate = $checklistTemplate;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, ProjetChecklistItem>
     */
    public function getProjetChecklistItems(): Collection
    {
        return $this->projetChecklistItems;
    }

    public function addProjetChecklistItem(ProjetChecklistItem $projetChecklistItem): static
    {
        if (!$this->projetChecklistItems->contains($projetChecklistItem)) {
            $this->projetChecklistItems->add($projetChecklistItem);
            $projetChecklistItem->setProjectChecklist($this);
        }

        return $this;
    }

    public function removeProjetChecklistItem(ProjetChecklistItem $projetChecklistItem): static
    {
        if ($this->projetChecklistItems->removeElement($projetChecklistItem)) {
            // set the owning side to null (unless already changed)
            if ($projetChecklistItem->getProjectChecklist() === $this) {
                $projetChecklistItem->setProjectChecklist(null);
            }
        }

        return $this;
    }
}
