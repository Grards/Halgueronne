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

        for($i=1; $i<=10; $i++){
            $utilisateur = new Utilisateurs();

            $nom = $faker->lastName();
            $prenom = $faker->firstNameMale();
            $pseudo = $faker->userName();
            $mdp = $faker->password();
            $email = $faker->freeEmail();
            $avatar = $faker->imageUrl(200,200);
            $rang = $faker->jobTitle();
            $naissance = $faker->dateTimeBetween($startDate = '-50 years', $endDate = '-18 years', $timezone = null);
            $slug = $faker->slug();

            $utilisateur->setNom($nom)
                        ->setPrenom($prenom)
                        ->setPseudo($pseudo)
                        ->setMdp($mdp)
                        ->setEmail($email)
                        ->setAvatar($avatar)
                        ->setRang($rang)
                        ->setNaissance($naissance)
                        ->setMessages(mt_rand(0,120))
                        ->setSlug($slug);

            $manager->persist($utilisateur);
        }
        
        $manager->flush();           
    }
}
