<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $roles = ['admin', 'member', 'affiliate'];

        foreach($roles as $r){
            $role = new Role();
            $role->setRole($r);
            $manager->persist($role);
        }

        $manager->flush();
    }
}
