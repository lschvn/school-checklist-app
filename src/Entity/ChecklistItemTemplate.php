<?php

namespace App\Entity;

use App\Repository\ChecklistItemTemplateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChecklistItemTemplateRepository::class)]
class ChecklistItemTemplate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column]
    private ?bool $is_required = null;

    #[ORM\Column]
    private ?int $position = null;

    #[ORM\ManyToOne(inversedBy: 'checklistItemTemplates')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ChecklistTemplate $checklistTemplate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function isRequired(): ?bool
    {
        return $this->is_required;
    }

    public function setIsRequired(bool $is_required): static
    {
        $this->is_required = $is_required;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getChecklistTemplate(): ?ChecklistTemplate
    {
        return $this->checklistTemplate;
    }

    public function setChecklistTemplate(?ChecklistTemplate $ChecklistTemplate): static
    {
        $this->checklistTemplate = $ChecklistTemplate;

        return $this;
    }
}
