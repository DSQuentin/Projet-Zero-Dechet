<?php

namespace App\DataFixtures;

use App\Entity\Annonces;
use App\Entity\User;
use App\Repository\AnnoncesRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $today = new \DateTime('NOW');
        $today->format('d/m/Y');


        for ($i = 0; $i<30; $i++){
            $annonce = new Annonces();
            $annonce->setTitle('Titre ' . $i)
                ->setContent("Contenu de l'annonce numéro " . $i . " qui est un peu long quand meme pour faire des tests")
                ->setCreatedAt($today);
            $manager->persist($annonce);
        }
        $manager->flush();
    }
}
