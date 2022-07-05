<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Image;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\ProduitFixtures;

class ImageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $image = new Image;
        $image 
            ->setImage("https://images-na.ssl-images-amazon.com/images/I/81VbZunq1CL.jpg")
            ->setImager($this->getReference("produit1"));
        $this->addReference('image1', $image);
       
        $manager->persist($image);
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            ProduitFixtures::class,
                     
        ];
    }
}
