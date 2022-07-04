<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait Enablable
{
    #[ORM\Column(type: 'boolean')]
    private $enabled = true;

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }
}