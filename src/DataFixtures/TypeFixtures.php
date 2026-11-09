<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $types = ['auteur', 'scénographe', 'comédien'];

        foreach($types as $t){
            $type = new Type();
            $type->setType($t);
            $manager->persist($type);
        }
        $manager->flush();
    }
}
