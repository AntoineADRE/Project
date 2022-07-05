<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SousCategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $sousCateg = new SousCategorie();
        $sousCateg 
            ->setLibelle('Fantasy')
            ->addCategory($this->getReference('categorie1'));
        $this->addReference('sousCateg1',$sousCateg);
        
        $manager->persist($sousCateg);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategorieFixtures::class,
        ];
    }
}