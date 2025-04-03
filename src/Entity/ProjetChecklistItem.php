<?php

namespace App\Entity;

use App\Repository\ProjetChecklistItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetChecklistItemRepository::class)]
class ProjetChecklistItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column]
    private ?bool $is_checked = null;

    #[ORM\Column]
    private ?int $position = null;

    #[ORM\ManyToOne(inversedBy: 'projetChecklistItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ProjetChecklist $projectChecklist = null;

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

    public function isChecked(): ?bool
    {
        return $this->is_checked;
    }

    public function setIsChecked(bool $is_checked): static
    {
        $this->is_checked = $is_checked;

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

    public function getProjectChecklist(): ?ProjetChecklist
    {
        return $this->projectChecklist;
    }

    public function setProjectChecklist(?ProjetChecklist $projectChecklist): static
    {
        $this->projectChecklist = $projectChecklist;

        return $this;
    }
}
