<?php

namespace App\DataFixtures;

use App\Entity\Utilisateurs;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UtilisateursFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        for($i=1; $i<=10; $i++){
            $utilisateur = new Utilisateurs();

            $utilisateur->setNom("Grard")
                        ->setPrenom("Steve")
                        ->setPseudo("Lucifer_Kira")
                        ->setMdp("Testmdp")
                        ->setEmail("grard.steve@gmail.com")
                        ->setAvatar("http://placehold.it/350x150")
                        ->setRang("Admin")
                        ->setNaissance(new \DateTime())
                        ->setMessages(0)
                        ->setSlug("grard.steve");

            $manager->persist($utilisateur);
        }
        
        $manager->flush();           
    }
}
