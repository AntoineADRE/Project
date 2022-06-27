<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\ManyToMany(targetEntity: SousCategorie::class, inversedBy: 'categories')]
    private $sousCateg;

    public function __construct()
    {
        $this->sousCateg = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, SousCategorie>
     */
    public function getSousCateg(): Collection
    {
        return $this->sousCateg;
    }

    public function addSousCateg(SousCategorie $sousCateg): self
    {
        if (!$this->sousCateg->contains($sousCateg)) {
            $this->sousCateg[] = $sousCateg;
        }

        return $this;
    }

    public function removeSousCateg(SousCategorie $sousCateg): self
    {
        $this->sousCateg->removeElement($sousCateg);

        return $this;
    }
}
