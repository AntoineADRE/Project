<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $date;

    #[ORM\OneToMany(mappedBy: 'panier', targetEntity: ItemPanier::class)]
    private $itemPaniers;

    public function __construct()
    {
        $this->itemPaniers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, ItemPanier>
     */
    public function getItemPaniers(): Collection
    {
        return $this->itemPaniers;
    }

    public function addItemPanier(ItemPanier $itemPanier): self
    {
        if (!$this->itemPaniers->contains($itemPanier)) {
            $this->itemPaniers[] = $itemPanier;
            $itemPanier->setPanier($this);
        }

        return $this;
    }

    public function removeItemPanier(ItemPanier $itemPanier): self
    {
        if ($this->itemPaniers->removeElement($itemPanier)) {
            // set the owning side to null (unless already changed)
            if ($itemPanier->getPanier() === $this) {
                $itemPanier->setPanier(null);
            }
        }

        return $this;
    }
}
