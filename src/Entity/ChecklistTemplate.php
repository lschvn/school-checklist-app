<?php

namespace App\Entity;

use App\Repository\ChecklistTemplateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChecklistTemplateRepository::class)]
class ChecklistTemplate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, ChecklistItemTemplate>
     */
    #[ORM\OneToMany(targetEntity: ChecklistItemTemplate::class, mappedBy: 'checklistTemplate', orphanRemoval: true)]
    private Collection $checklistItemTemplates;

    /**
     * @var Collection<int, ProjetChecklist>
     */
    #[ORM\OneToMany(targetEntity: ProjetChecklist::class, mappedBy: 'checklistTemplate')]
    private Collection $projetChecklists;

    public function __construct()
    {
        $this->checklistItemTemplates = new ArrayCollection();
        $this->projetChecklists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, ChecklistItemTemplate>
     */
    public function getChecklistItemTemplates(): Collection
    {
        return $this->checklistItemTemplates;
    }

    public function addChecklistItemTemplate(ChecklistItemTemplate $checklistItemTemplate): static
    {
        if (!$this->checklistItemTemplates->contains($checklistItemTemplate)) {
            $this->checklistItemTemplates->add($checklistItemTemplate);
            $checklistItemTemplate->setChecklistTemplate($this);
        }

        return $this;
    }

    public function removeChecklistItemTemplate(ChecklistItemTemplate $checklistItemTemplate): static
    {
        if ($this->checklistItemTemplates->removeElement($checklistItemTemplate)) {
            // set the owning side to null (unless already changed)
            if ($checklistItemTemplate->getChecklistTemplate() === $this) {
                $checklistItemTemplate->setChecklistTemplate(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProjetChecklist>
     */
    public function getProjetChecklists(): Collection
    {
        return $this->projetChecklists;
    }

    public function addProjetChecklist(ProjetChecklist $projetChecklist): static
    {
        if (!$this->projetChecklists->contains($projetChecklist)) {
            $this->projetChecklists->add($projetChecklist);
            $projetChecklist->setChecklistTemplate($this);
        }

        return $this;
    }

    public function removeProjetChecklist(ProjetChecklist $projetChecklist): static
    {
        if ($this->projetChecklists->removeElement($projetChecklist)) {
            // set the owning side to null (unless already changed)
            if ($projetChecklist->getChecklistTemplate() === $this) {
                $projetChecklist->setChecklistTemplate(null);
            }
        }

        return $this;
    }
}
