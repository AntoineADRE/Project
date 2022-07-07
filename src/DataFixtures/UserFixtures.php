<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user
            ->setEmail('user@mail.fr')
            ->setRoles(['ROLE_USER'])
            ->setPassword('user')
            ->setNom('user')
            ->setPrenom('user');
        $this->addReference('user', $user);
        $manager->persist($user);

        $admin = new User();
        $admin
            ->setEmail('admin@mail.fr')
            ->setRoles(['ROLE_ADMIN', 'ROLE_USER'])
            ->setPassword('admin')
            ->setNom('admin')
            ->setPrenom('admin');
        $this->addReference('admin', $admin);
        $manager->persist($admin);
        $manager->flush();
    }
}
