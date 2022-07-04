<?php

namespace App\Entity;

use App\Repository\PropertyFeatureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PropertyFeatureRepository::class)]
class PropertyFeature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $value;

    #[ORM\ManyToOne(targetEntity: Property::class, inversedBy: 'features')]
    #[ORM\JoinColumn(name: 'property_id', referencedColumnName: 'id', nullable: false)]
    private $property;

    #[ORM\ManyToOne(targetEntity: Feature::class)]
    #[ORM\JoinColumn(name: 'feature_id', referencedColumnName: 'id', nullable: false)]
    private $feature;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getProperty(): ?Property
    {
        return $this->property;
    }

    public function setProperty(?Property $property): self
    {
        $this->property = $property;

        return $this;
    }

    public function getFeature(): ?Feature
    {
        return $this->feature;
    }

    public function setFeature(?Feature $feature): self
    {
        $this->feature = $feature;

        return $this;
    }
}
