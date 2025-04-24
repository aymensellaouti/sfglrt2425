<?php

namespace App\Traits;
use Doctrine\ORM\Mapping as ORM;
trait TimeStampTrait
{
    #[ORM\Column(type:"datetime", nullable:true)]
    private \DateTime $createdAt;

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    #[ORM\PrePersist()]
    public function onPrePersist(): void {
        $this->createdAt = new \DateTime();
    }

}