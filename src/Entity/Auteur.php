<?php

namespace App\Entity;

use App\Repository\AuteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuteurRepository::class)]
class Auteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    #[ORM\ManyToMany(targetEntity: Produit::class, inversedBy: 'auteurs')]
    private $ecrit;

    public function __construct()
    {
        $this->ecrit = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getEcrit(): Collection
    {
        return $this->ecrit;
    }

    public function addEcrit(Produit $ecrit): self
    {
        if (!$this->ecrit->contains($ecrit)) {
            $this->ecrit[] = $ecrit;
        }

        return $this;
    }

    public function removeEcrit(Produit $ecrit): self
    {
        $this->ecrit->removeElement($ecrit);

        return $this;
    }
}
