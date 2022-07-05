<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Categorie;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\SousCategorieFixtures;


class CategorieFixtures extends Fixture implements DependentFixtureInterface
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