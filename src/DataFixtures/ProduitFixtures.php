<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\CategorieFixtures;
use App\DataFixtures\AuteurFixtures;
use App\DataFixtures\ImageFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProduitFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $produit=new Produit();
        $produit   
            ->setNom("The Witcher")
            ->setDescription("Un sorceleur vient casser la bouche des monstres.")
            ->setPrix(25.99)
            ->setTva(14)
            ->setCodeBarre("8152124125968")
            ->setDateSortie('02-17-1999 08:54')
            ->setQuantite(50)
            ->setCategorie($this->getReference("categorie1"));


        $this->addReference('produit1', $produit);
        $manager->persist($produit);
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            CategorieFixtures::class,
              
        ];
    }
}