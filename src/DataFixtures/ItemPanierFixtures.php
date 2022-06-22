<?php

namespace App\DataFixtures;

use App\Entity\ItemPanier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\PanierFixtures;
use App\DataFixtures\ProduitFixtures;

class ItemPanierFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        //TO DO : RELATIONS AVEC LES PRODUITS

        $itemPanier = new ItemPanier();
        $itemPanier
            ->setProduit($this->getReference('?'))
            ->setPanier($this->getReference('panier1'))
            ->setQuantite(2);

        $this->addReference('itemPanier1', $itemPanier);
        $manager->persist($itemPanier);

        $itemPanier = new ItemPanier();
        $itemPanier
            ->setProduit($this->getReference('?'))
            ->setPanier($this->getReference('panier1'))
            ->setQuantite(1);
        $this->addReference('itemPanier2', $itemPanier);
        $manager->persist($itemPanier);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProduitFixtures::class,
            PanierFixtures::class
        ];
    }
}
