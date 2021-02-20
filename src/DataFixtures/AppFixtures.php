<?php

namespace App\DataFixtures;

use App\Entity\Annonces;
use App\Entity\User;
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
            $author = new User();
            $author->setUsername("Auteur " . $i)
                ->setEmail("auteur" . $i . "@mail.com")
                ->setPassword("testtest")
                ->setProfilePic('img/default_profile_pic.jpeg')
                ->setRoles(["ROLE_USER"]);
            $manager->persist($author);

            $annonce = new Annonces();
            $annonce->setTitle('Titre ' . $i)
                ->setContent("Contenu de l'annonce numéro " . $i . " qui est un peu long quand meme pour faire des tests")
                ->setCreatedAt($today)
                ->setAuthor($author);
            $manager->persist($annonce);

        }
        $manager->flush();
    }
}
