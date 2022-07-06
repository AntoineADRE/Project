<?php

namespace App\DataFixtures;

use App\Entity\Panier;
use Doctrine\Bundle\FixturesBundle\Fixture;

use Doctrine\Persistence\ObjectManager;



class PanierFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //TO DO : RELATIONS AVEC LES USERS
        $panier = new Panier();
        $panier
            ->setDate('06-22-2022 08:54');
        $this->addReference('panier1', $panier);
        $manager->persist($panier);
        $manager->flush();
    }


    
}
