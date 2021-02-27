<?php

namespace App\DataFixtures;

use App\Entity\Villes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class VillesFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['group1'];
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $json = file_get_contents('ressources/cities.json');
        $jsonfile = json_decode($json, true);

        for($i = 0; $i < sizeof($jsonfile); $i++){
            if ($jsonfile[$i]["department_code"]==45){
                $ville = new Villes();
                $ville->setName($jsonfile[$i]["name"])
                    ->setZip((string)$jsonfile[$i]["zip_code"]);
                $manager->persist($ville);
            }
        }
        $manager->flush();
    }
}
