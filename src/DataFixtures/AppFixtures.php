<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Utilisateurs;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('Fr-fr');

        // for($i=1; $i<=30; $i++){
        //     $badge = new Badges();

        //     $titre = $faker->sentence($nbWords = 6, $variableNbWords = true);
        //     $description = $faker->paragraphs($nb = 3, $asText = false);
        //     $image = $faker->imageUrl(150,150);

        //     $badge->setTitre($titre)
        //           ->setDescription($description)
        //           ->setImage($image)
        //           ->setSlug($slug);

        //     $manager->persist($badge);
        // }

        for($i=1; $i<=10; $i++){
            $utilisateur = new Utilisateurs();

            $pseudo = $faker->userName();
            $mdp = $faker->password();
            $email = $faker->freeEmail();
            $avatar = $faker->imageUrl(200,200);
            $rang = $faker->jobTitle();

            $utilisateur->setPseudo($pseudo)
                        ->setMdp($mdp)
                        ->setEmail($email)
                        ->setAvatar($avatar)
                        ->setRang($rang)
                        ->setMessages(mt_rand(0,120));

            $manager->persist($utilisateur);
        }


        
        $manager->flush();           
    }
}
