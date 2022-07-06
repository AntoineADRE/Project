<?php

namespace App\DataFixtures;
use App\Entity\Auteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\ProduitFixtures;


class AuteurFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $auteur = new Auteur;
        $auteur 
            ->setNom("Sapkowski")
            ->setPrenom("Andrzej ")
            ->addEcrit($this->getReference("produit1"));
            ;
            
        $this->addReference('auteur1', $auteur);
        $manager->persist($auteur);
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            ProduitFixtures::class,
              
        ];
    }
}
