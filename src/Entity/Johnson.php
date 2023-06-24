<?php

namespace App\Entity;

use App\Repository\JohnsonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JohnsonRepository::class)]
class Johnson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $colonnes = null;

    #[ORM\Column]
    private ?float $decalage = null;

    #[ORM\Column]
    private ?int $ecart = null;

    #[ORM\Column]
    private ?float $angle = null;

    #[ORM\Column]
    private ?float $angledecoratif = null;

    #[ORM\Column]
    private ?float $rayondecoratif = null;

    #[ORM\Column]
    private ?int $decalagedecoratif = null;

    #[ORM\Column(nullable: true)]
    private ?int $couleursaleatoires = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $couleur1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $couleur2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $couleur3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $couleur4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $couleur5 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColonnes(): ?int
    {
        return $this->colonnes;
    }

    public function setColonnes(int $colonnes): static
    {
        $this->colonnes = $colonnes;

        return $this;
    }

    public function getDecalage(): ?float
    {
        return $this->decalage;
    }

    public function setDecalage(float $decalage): static
    {
        $this->decalage = $decalage;

        return $this;
    }

    public function getEcart(): ?int
    {
        return $this->ecart;
    }

    public function setEcart(int $ecart): static
    {
        $this->ecart = $ecart;

        return $this;
    }

    public function getAngle(): ?float
    {
        return $this->angle;
    }

    public function setAngle(float $angle): static
    {
        $this->angle = $angle;

        return $this;
    }

    public function getAngledecoratif(): ?float
    {
        return $this->angledecoratif;
    }

    public function setAngledecoratif(float $angledecoratif): static
    {
        $this->angledecoratif = $angledecoratif;

        return $this;
    }

    public function getRayondecoratif(): ?float
    {
        return $this->rayondecoratif;
    }

    public function setRayondecoratif(float $rayondecoratif): static
    {
        $this->rayondecoratif = $rayondecoratif;

        return $this;
    }

    public function getDecalagedecoratif(): ?int
    {
        return $this->decalagedecoratif;
    }

    public function setDecalagedecoratif(int $decalagedecoratif): static
    {
        $this->decalagedecoratif = $decalagedecoratif;

        return $this;
    }

    public function getCouleursaleatoires(): ?int
    {
        return $this->couleursaleatoires;
    }

    public function setCouleursaleatoires(?int $couleursaleatoires): static
    {
        $this->couleursaleatoires = $couleursaleatoires;

        return $this;
    }

    public function getCouleur1(): ?string
    {
        return $this->couleur1;
    }

    public function setCouleur1(?string $couleur1): static
    {
        $this->couleur1 = $couleur1;

        return $this;
    }

    public function getCouleur2(): ?string
    {
        return $this->couleur2;
    }

    public function setCouleur2(?string $couleur2): static
    {
        $this->couleur2 = $couleur2;

        return $this;
    }

    public function getCouleur3(): ?string
    {
        return $this->couleur3;
    }

    public function setCouleur3(?string $couleur3): static
    {
        $this->couleur3 = $couleur3;

        return $this;
    }

    public function getCouleur4(): ?string
    {
        return $this->couleur4;
    }

    public function setCouleur4(?string $couleur4): static
    {
        $this->couleur4 = $couleur4;

        return $this;
    }

    public function getCouleur5(): ?string
    {
        return $this->couleur5;
    }

    public function setCouleur5(?string $couleur5): static
    {
        $this->couleur5 = $couleur5;

        return $this;
    }
}
