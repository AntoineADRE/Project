<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       $categorie = new Categorie();
       $categorie 
            ->setNom('Roman')
            ->addSousCateg($this->getReference('sousCateg1'));

        $this->addReference('categorie1',$categorie);
        
        $manager->persist($categorie);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SousCategorieFixtures::class,
            
        ];
    }
}