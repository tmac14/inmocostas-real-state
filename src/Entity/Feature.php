<?php

namespace App\Entity;

use App\Entity\Traits\Enablable;
use App\Repository\FeatureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FeatureRepository::class)]
#[ORM\Table(name: '`features`')]
class Feature
{
    use Enablable;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 12)]
    private $valueType;

    #[ORM\Column(type: 'text', nullable: true)]
    private $valueFormat;

    #[ORM\Column(type: 'string', length: 45, nullable: true)]
    private $icon;

    public function __toString(): string
    {
        return $this->name;
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

    public function getValueType(): ?string
    {
        return $this->valueType;
    }

    public function setValueType(string $valueType): self
    {
        $this->valueType = $valueType;

        return $this;
    }

    public function getValueFormat(): ?string
    {
        return $this->valueFormat;
    }

    public function setValueFormat(string $valueFormat): self
    {
        $this->valueFormat = $valueFormat;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }
}
