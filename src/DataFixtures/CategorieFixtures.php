<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Categorie;



class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       $categorie = new Categorie();
       $categorie 
            ->setNom('Roman');

        $this->addReference('categorie1',$categorie);
        
        $manager->persist($categorie);
        $manager->flush();
    }


}