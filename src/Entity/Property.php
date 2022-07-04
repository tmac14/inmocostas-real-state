<?php

namespace App\Entity;

use App\Entity\Traits\Enablable;
use App\Entity\Traits\Timestable;
use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PropertyRepository::class)]
#[ORM\Table(name: '`properties`')]
#[ORM\HasLifecycleCallbacks()]
class Property
{
    use Timestable;
    use Enablable;

    const PROPERTY_CONSERVATION_STATUSES = [
        'work under construction'   => 1,
        'new construction'          => 2,
        'good condition'            => 3,
        'renovated'                 => 4,
        'for complete renovation'   => 5,
        'for parcial renovation'    => 6,
    ];

    const PROPERTY_TRANSACTION_TYPES = [
        'for sale'      => 1,
        'for rent'      => 2,
        'for rent own'  => 3,
    ];

    const PROPERTY_EXTERNAL_AGENCY_STATUSES = [
        'under study'           => 1,
        'in marketing'          => 2,
        'reserved'              => 3,
        'closed transaction'    => 4,
    ];

    const PROPERTY_INTERNAL_AGENCY_STATUSES = [
        'requested'             => 1,
        'rejected'              => 2,
        'accepted'              => 3,
        'in marketing'          => 4,
        'reserved'              => 5,
        'closed transaction'    => 6,
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 45)]
    private $title;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private $surfaceUtil;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private $surfaceBuilt;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private $surfaceSimpleNote;

    #[ORM\Column(type: 'smallint')]
    private $rooms;

    #[ORM\Column(type: 'smallint')]
    private $bathrooms;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 7, nullable: true)]
    private $latitude;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 7, nullable: true)]
    private $longitude;

    #[ORM\Column(type: 'integer')]
    private $price;

    #[ORM\Column(type: 'string', length: 15)]
    private $internalRef;

    #[ORM\Column(type: 'string', length: 30, nullable: true)]
    private $externalRef;

    #[ORM\OneToMany(mappedBy: 'property', targetEntity: PropertyFeature::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private $features;

    #[ORM\Column(type: 'smallint', nullable: true)]
    private $yearBuilt;

    #[ORM\ManyToOne(targetEntity: PropertyClass::class, inversedBy: 'properties')]
    #[ORM\JoinColumn(nullable: false)]
    private $propertyClass;

    #[ORM\Column(type: 'smallint', nullable: true)]
    private $internalAgencyStatus;

    #[ORM\Column(type: 'smallint', nullable: true)]
    private $externalAgencyStatus;

    #[ORM\Column(type: 'smallint', nullable: true)]
    private $transactionType;

    #[ORM\Column(type: 'smallint', nullable: true)]
    private $conservationStatus;

    #[ORM\OneToMany(mappedBy: 'property', targetEntity: AttachmentPropertyPhoto::class, orphanRemoval: true)]
    private $photos;

    public function __construct()
    {
        $this->features = new ArrayCollection();
        $this->photos = new ArrayCollection();
    }

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

    public function getSurfaceUtil(): ?string
    {
        return $this->surfaceUtil;
    }

    public function setSurfaceUtil(?string $surfaceUtil): self
    {
        $this->surfaceUtil = $surfaceUtil;

        return $this;
    }

    public function getSurfaceBuilt(): ?string
    {
        return $this->surfaceBuilt;
    }

    public function setSurfaceBuilt(?string $surfaceBuilt): self
    {
        $this->surfaceBuilt = $surfaceBuilt;

        return $this;
    }

    public function getSurfaceSimpleNote(): ?string
    {
        return $this->surfaceSimpleNote;
    }

    public function setSurfaceSimpleNote(?string $surfaceSimpleNote): self
    {
        $this->surfaceSimpleNote = $surfaceSimpleNote;

        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(int $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getBathrooms(): ?int
    {
        return $this->bathrooms;
    }

    public function setBathrooms(int $bathrooms): self
    {
        $this->bathrooms = $bathrooms;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getInternalRef(): ?string
    {
        return $this->internalRef;
    }

    public function setInternalRef(?string $internalRef): self
    {
        $this->internalRef = $internalRef;

        return $this;
    }

    public function getExternalRef(): ?string
    {
        return $this->externalRef;
    }

    public function setExternalRef(?string $externalRef): self
    {
        $this->externalRef = $externalRef;

        return $this;
    }

    /**
     * @return Collection<int, PropertyFeature>
     */
    public function getFeatures(): Collection
    {
        return $this->features;
    }

    public function addFeature(PropertyFeature $feature): self
    {
        if (!$this->features->contains($feature)) {
            $this->features[] = $feature;
            $feature->setProperty($this);
        }

        return $this;
    }

    public function removeFeature(PropertyFeature $feature): self
    {
        if ($this->features->removeElement($feature)) {
            // set the owning side to null (unless already changed)
            if ($feature->getProperty() === $this) {
                $feature->setProperty(null);
            }
        }

        return $this;
    }

    public function getYearBuilt(): ?int
    {
        return $this->yearBuilt;
    }

    public function setYearBuilt(?int $yearBuilt): self
    {
        $this->yearBuilt = $yearBuilt;

        return $this;
    }

    public function getPropertyClass(): ?PropertyClass
    {
        return $this->propertyClass;
    }

    public function setPropertyClass(?PropertyClass $propertyClass): self
    {
        $this->propertyClass = $propertyClass;

        return $this;
    }

    public function getInternalAgencyStatus(): ?int
    {
        return $this->internalAgencyStatus;
    }

    public function setInternalAgencyStatus(?int $internalAgencyStatus): self
    {
        $this->internalAgencyStatus = $internalAgencyStatus;

        return $this;
    }

    public function getExternalAgencyStatus(): ?int
    {
        return $this->externalAgencyStatus;
    }

    public function setExternalAgencyStatus(?int $externalAgencyStatus): self
    {
        $this->externalAgencyStatus = $externalAgencyStatus;

        return $this;
    }

    public function getTransactionType(): ?int
    {
        return $this->transactionType;
    }

    public function setTransactionType(int $transactionType): self
    {
        $this->transactionType = $transactionType;

        return $this;
    }

    public function getConservationStatus(): ?int
    {
        return $this->conservationStatus;
    }

    public function setConservationStatus(?int $conservationStatus): self
    {
        $this->conservationStatus = $conservationStatus;

        return $this;
    }

    /**
     * @return Collection<int, AttachmentPropertyPhoto>
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(AttachmentPropertyPhoto $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setProperty($this);
        }

        return $this;
    }

    public function removePhoto(AttachmentPropertyPhoto $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getProperty() === $this) {
                $photo->setProperty(null);
            }
        }

        return $this;
    }
}
