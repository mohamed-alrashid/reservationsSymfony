<?php

namespace App\DataFixtures;

use App\Entity\Locality;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LocalityFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $locality = [
            [
                'postalCode' => '1210',
                'localityName' => " Avenue de l'Astronomie 19 Saint-Josse-ten-Noode",
            ],
        ];

        foreach($locality as $l){
            $localite = new Locality();
            $localite->setPostalCode($l['postalCode']);
            $localite->setLocalityName($l['localityName']);
            $manager->persist($localite);
        }

        $manager->flush();
    }
}
