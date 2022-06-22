<?php

namespace App\DataFixtures;

use App\Entity\Panier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\PanierFixtures;
use App\DataFixtures\UserFixtures;

class ItemPanierFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        //TO DO : RELATIONS AVEC LES USERS
        $panier = new Panier();
        $panier
            ->setUser($this->getReference('user1'))
            ->addItemPanier($this->getReference('itemPanier1'))
            ->addItemPanier($this->getReference('itemPanier2'))
            ->setDate(\DateTime::createFromFormat('d-m-y H:i', '06-22-2022 08:54'));
        $this->addReference('panier1', $panier);
        $manager->persist($panier);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ItemPanierFixtures::class,
            UserFixtures::class
        ];
    }
}
