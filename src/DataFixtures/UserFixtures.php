<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
<<<<<<< HEAD
        $user = new User;
=======
        $usert = new User;
>>>>>>> Antoine

        $manager->flush();
    }
}
