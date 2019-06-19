<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Utilisateurs;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }

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
            
            /* On donne le mot de passe 'password' par défaut aux Fakers, qui sont ensuite cryptés dans la BDD, en guise de test */
            $hash = $this->encoder->encodePassword($utilisateur, 'password');

            $pseudo = $faker->userName();
            $email = $faker->freeEmail();
            $avatar = $faker->imageUrl(200,200);
            $rang = $faker->jobTitle();

            $utilisateur->setPseudo($pseudo)
                        ->setMdp($hash)
                        ->setEmail($email)
                        ->setAvatar($avatar)
                        ->setRang($rang)
                        ->setMessages(mt_rand(0,120));

            $manager->persist($utilisateur);
        }


        
        $manager->flush();           
    }
}
