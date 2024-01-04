<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('yen@gmail.com');
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setPassword(' $2a$12$FgEeZad5WUIVi4Vp12Zd5.rAQeZ.tsV4/P4/8p.GdFc4Suz5wFquu ');


        $manager->persist($user);

        $manager->flush();
    }
}
