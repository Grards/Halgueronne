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

            $avatar = $faker->imageUrl(50,50);

            $utilisateur->setNom("Grard")
                        ->setPrenom("Steve")
                        ->setPseudo("Lucifer_Kira")
                        ->setMdp("Testmdp")
                        ->setEmail("grard.steve@gmail.com")
                        ->setAvatar($avatar)
                        ->setRang("Admin")
                        ->setNaissance(new \DateTime())
                        ->setMessages(0)
                        ->setSlug("grard.steve");

            $manager->persist($utilisateur);
        }
        
        $manager->flush();           
    }
}
