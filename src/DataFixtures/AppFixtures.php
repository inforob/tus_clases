<?php

namespace App\DataFixtures;

use App\Entity\Cliente;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('yen@gmail.com');
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setPassword('$2a$12$952QOJ7txHqVZNQMPaIxiOoCJA.M84MNLKcKfC/6/Zl.6R6QAEZb2');

        $user = new User();
        $user->setEmail('inforob@gmail.com');
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setPassword('$2a$12$952QOJ7txHqVZNQMPaIxiOoCJA.M84MNLKcKfC/6/Zl.6R6QAEZb2');

        $manager->persist($user);

        $fake = Factory::create();
        for ($i=0;$i<5000;$i++) {
            $cliente = new Cliente();
            $cliente->setNombre($fake->name);
            $cliente->setPersonaContacto(sprintf('%s %s', $fake->name,$fake->lastName));
            $cliente->setDireccion($fake->address);
            $cliente->setNif($fake->randomNumber(7) . $fake->randomLetter());
            $cliente->setLocalidad($fake->city);

            $manager->persist($cliente);
        }



        $manager->flush();
    }
}
