<?php

namespace App\Entity;

use App\Repository\NeesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NeesRepository::class)]
class Nees
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $amplitude = null;

    #[ORM\Column]
    private ?float $angle = null;

    #[ORM\Column]
    private ?int $colonnes = null;

    #[ORM\Column]
    private ?int $lignes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmplitude(): ?float
    {
        return $this->amplitude;
    }

    public function setAmplitude(float $amplitude): self
    {
        $this->amplitude = $amplitude;

        return $this;
    }

    public function getAngle(): ?float
    {
        return $this->angle;
    }

    public function setAngle(float $angle): self
    {
        $this->angle = $angle;

        return $this;
    }

    public function getColonnes(): ?int
    {
        return $this->colonnes;
    }

    public function setColonnes(int $colonnes): self
    {
        $this->colonnes = $colonnes;

        return $this;
    }

    public function getLignes(): ?int
    {
        return $this->lignes;
    }

    public function setLignes(int $lignes): self
    {
        $this->lignes = $lignes;

        return $this;
    }
}
