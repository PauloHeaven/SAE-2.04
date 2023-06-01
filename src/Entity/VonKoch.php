<?php

namespace App\Entity;

use App\Repository\VonKochRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VonKochRepository::class)]
class VonKoch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $dimension = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDimension(): ?int
    {
        return $this->dimension;
    }

    public function setDimension(int $dimension): self
    {
        $this->dimension = $dimension;

        return $this;
    }
}
