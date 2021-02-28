<?php

namespace App\DataFixtures;

use App\Entity\Annonces;
use App\Entity\Comment;
use App\Entity\User;
use App\Entity\Villes;
use App\Repository\VillesRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture implements FixtureGroupInterface
{

    public static function getGroups(): array
    {
        return ['group2'];
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $today = new \DateTime('NOW');
        $today->format('d/m/Y');
        $villetest = new Villes();
        $villetest->setName("Ville test")
            ->setZip("00000");
        $manager->persist($villetest);


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
                ->setAuthor($author)
                ->setVille($villetest);
            $manager->persist($annonce);

            $comment = new Comment();
            $comment->setAuthor($author)
                ->setCreatedAt($today)
                ->setContent('Commentaire de test ' . $i)
                ->setAnnonces($annonce);
            $manager->persist($comment);

            $comment2 = new Comment();
            $comment2->setAuthor($author)
                ->setCreatedAt($today)
                ->setContent('Commentaire 2 de test ' . $i)
                ->setAnnonces($annonce);
            $manager->persist($comment2);

        }
        $manager->flush();
    }

}
